<?php
class chatBackendController extends BackendResourceController {

    public $userTypeVsChatUserTypeMap = array();

    function __construct() {


        $this->nonauth['index'] = 1;
        $this->nonauth['ajaxStrangerChatConnect'] = 1;
        $this->nonauth['ajaxReadPackets'] = 1;
        $this->nonauth['ajaxhandlesignal'] = 1;
        $this->nonauth['ajaxPostMessage'] = 1;
        $this->nonauth['ajaxDisconnectChat'] =1;
        $this->nonauth['createRoom'] = 1;
        $this->nonauth['ajaxGetMyMessages'] = 1;
        $userTypeVsChatUserTypeMap = array();
        $userTypeVsChatUserTypeMap['user'] = "agent";

        $this->userTypeVsChatUserTypeMap = array_merge($userTypeVsChatUserTypeMap,array_flip($userTypeVsChatUserTypeMap));

    }


    function action_createRoom(){

        if(isset($_POST['formdata'])) {
            $entity = lib_entity::getInstance();
            $data = array();
            $data['name'] = uniqid();
            $desc = "";
            foreach($_POST['formdata'] as $row) {
                $desc .= $row['name'].' : '.$row['value'].'<br />';
            }
            $data['description']  = $desc;
            $data["max_member"] = "2";
            $roomId = $entity->save("chatroom",$data);
            $data['name']  = $_SERVER['REMOTE_ADDR'];
            $data['desc'] = "";
            $memberId = $entity->save("room_member",$data);
            $cmd = "mkdir -p ".lib_config::getInstance()->get("basepath").'cache/rooms/'.$roomId.'/'.$memberId;
            shell_exec($cmd);
            $data = array();
            $data["chatroom_id"] = $roomId;
            $data["room_member_id"] = $memberId;
            $entity->save("chatroom_room_member_m_m",$data);
            $_SESSION['room_member_id'][$roomId] = $memberId;

            $path =lib_config::getInstance()->get("basepath").'cache/workbench/';

            $this->broadcastMessage($path, $roomId,array("room_id"=>$roomId));
            $this->sendResponse(200, array("room_id"=>$roomId,"member_id"=>$memberId));

        } else {
            $this->sendResponse("401", "Invalid Request");
        }


    }


    function broadcastMessage($path,$id,$message=array()) {
        $files = scandir($path);
        if($files) {
            unset($files[0]);
            unset($files[1]);
            $msgId =uniqid();
            foreach($files as $directory) {
                $participantPath = $path.'/'.$directory.'/';
                if(is_dir($participantPath) && $directory !=$id) {
                    file_put_contents($participantPath.$msgId, json_encode($message));
                }
            }
        }
    }


    function broadcastMessageToRoom($roomId,$memberId,$message=array()) {
        $path =lib_config::getInstance()->get("basepath").'cache/rooms/'.$roomId;
        $this->broadcastMessage($path, $memberId, $message);
    }

    function action_ajaxGetMyMessages() {
        if(isset($_REQUEST['room_id']) && isset($_REQUEST['member_id'])) {
            $roomId = $_REQUEST['room_id'];
            $memberId = $_REQUEST['member_id'];
            $path =lib_config::getInstance()->get("basepath").'cache/rooms/'.$roomId.'/'.$memberId;
            $files = scandir($path);
            $messages = array();
            if($files) {
                unset($files[0]);
                unset($files[1]);
                foreach($files as $file) {
                    $messages[] =  file_get_contents($path.'/'.$file);
                    unlink($path.'/'.$file);
                }
            }
            $this->sendResponse(200, array("messages"=>$messages));
        } else {
            $this->sendResponse(401, "you are not qualityfiled");
        }
    }

    function action_join() {
        $currentUser = lib_current_user::getEntityInstance();
        if(!($currentUser && (isset($currentUser->privileges['agent.live.chat']) || $currentUser->user_type=="developer"))) {
            die("access denied");
        }
        if(isset($_GET['room_id'])) {
            $roomId = $_GET['room_id'];
            $memberId = "";

            if(isset($_SESSION['joinedroom_member_id'][$roomId])) {
                $memberId = $_SESSION['joinedroom_member_id'][$roomId];
                $sql = "select * from chatroom_room_member_m_m where deleted=0 and room_member_id='".$memberId."' ";
                $qry= lib_mysqli::getInstance()->query($sql);
                if($qry->num_rows > 5) {
                    die("Access denied for join room with more than 5 users");
                }
            }


                $this->params['is_agent_livechat'] =true;
                $room = lib_entity::getInstance()->get("chatroom", $roomId);
                if($room) {
                    $this->params['chatroom'] = $room;
                    //unset($_SESSION['joinedroom_member_id'][$roomId]);
                    if(isset($_SESSION['joinedroom_member_id'][$roomId])) {
                        $memberId = $_SESSION['joinedroom_member_id'][$roomId];
                    } else {
                        $sql = "select * from chatroom_room_member_m_m where deleted=0 and chatroom_id='".$roomId."' ";
                        $qry= lib_mysqli::getInstance()->query($sql);
                        if($qry->num_rows < $room['max_member']) {
                            $this->params['showheaderfooter'] =true;
                            $this->params['room_id'] = $roomId;
                            $data = array();
                            $data['name'] = $currentUser->user_name;
                            $data['description'] = "";
                            $memberId = lib_entity::getInstance()->save("room_member", $data);
                            $mypath = lib_config::getInstance()->get("basepath").'cache/rooms/'.$roomId.'/'.$memberId;
                            $cmd = 'mkdir -p '.$mypath;
                            shell_exec($cmd);

                            $data = array();
                            $data["chatroom_id"] = $roomId;
                            $data["room_member_id"] = $memberId;
                            lib_entity::getInstance()->save("chatroom_room_member_m_m", $data);
                            $_SESSION['joinedroom_member_id'][$roomId] = $memberId;


                            $message = array("type"=>"connected","message"=>$currentUser->user_name." joined.");
                            $this->broadcastMessageToRoom($roomId, $memberId, $message);

                        } else {
                            die("Chatroom is full with ".$qry->num_rows." members");
                        }
                    }
                    $this->params['room_id'] = $roomId;
                    $this->params['member_id'] = $memberId;
                    $this->params['showheaderfooter'] =true;
                    $this->view = "index";
                }




        }



    }

    function action_index() {
        $this->params['showheaderfooter'] =false;
        $this->params['is_agent_livechat'] =false;
        $this->view = "index";

    }





    function action_getInitMessage() {
        $db = lib_mysqli::getInstance();
	    $current_user = lib_current_user::getEntityInstance();


        $result = array("status"=>"fail");

        if($current_user) {

            if(isset($current_user->privileges['agent.live.chat'])) {


                $sessionId = session_id();
                $sql = "select * from strangerchat where  st_session_id='".$sessionId."' and usertype='user'  ";
                $result['sql']  = $sql;

                $row = $db->getrow($sql);

                if($row) {

                    $result = array("status"=>"success","desc"=>$row['description']);

                }

            }


        }

        echo json_encode($result);
    }

    function action_ajaxStrangerChatConnect(){
        $db = lib_mysqli::getInstance();
	    $entity = lib_entity::getInstance();
        $current_user =lib_current_user::getEntityInstance();


        $stdesc = "";
        $userType = "user";
        if($current_user) {
            $userType = "backenduser";
            if(isset($current_user->privileges['agent.live.chat'])) {
                $userType = "agent";
            }
        } else  {


            if(isset($_POST['formdata'])) {
                foreach($_POST['formdata'] as $data) {
                    $stdesc .= $data['name']." : ".$data['value']."<br />";
                }

            }

        }


        $result = array('status'=>'no_user_avail','chatId'=>'');

        $targetUser = false;
        if(isset($this->userTypeVsChatUserTypeMap[$userType])) {
            $targetUser = $this->userTypeVsChatUserTypeMap[$userType];
        } else {
            echo json_encode($result);
            exit();
        }

        $sessionId = session_id();

        $sql = "delete from webrtcsignal where session_id='".$sessionId."'";
        $db->query($sql);
        $sql = "delete from strangerchat where name='".$sessionId."'";
        $db->query($sql);

        $sql = "select * from strangerchat where status='available' and usertype='".$targetUser."' and name !='".$sessionId."' and deleted=0 limit 1";
        $result['packets'] = array();
        $result['name'] = "Friend";

        $row = $db->getrow($sql,array("name"));
        if($row) {
            $result['status'] = "answer";
            $_SESSION['strangersessionid'] = $row['name'];
            $_SESSION['strangerchatstatus'] = "engaged";


            $data =array();
            $sql = "select * from strangerchat where  name ='".$sessionId."' and deleted=0 ";
            $data = $db->getrow($sql,array("name"));
            $data['st_session_id'] = $row['name'];
            $data['name'] = $sessionId;
            $data['status'] = "engaged";
            $data['usertype'] = $userType;
            if($stdesc) {
                $data['description'] = $stdesc;

                $mdata = array();
                $mdata['name'] = 'message';
                $mdata['description'] = $stdesc;
                $mdata['session_id'] = $sessionId;
                $entity->save("webrtcsignal",$mdata);

            }
            $entity->save("strangerchat",$data);

            $row['status'] = "engaged";
            $row['st_session_id'] = $sessionId;
            $entity->save("strangerchat",$row);

            $sql = "select * from webrtcsignal where  deleted=0 and session_id='".$row['name']."' order by date_entered asc";
            $rows = $db->fetchRows($sql);

            $result['packets'] = array();
            if($row['usertype']=='agent') {
                $sql = "select name  from user where id = '".$row['created_by']."'";
                $uinfo = $db->getrow($sql);
                if($uinfo) {
                    $result['name'] = $uinfo['name'];

                }
            }
            $result['packets'] = $this->processPackets($rows);



            $_SESSION['strangerchatstatus'] = "engaged";


        } else if($userType!="user"){

            $sql = "select * from strangerchat where  name ='".$sessionId."' and deleted=0 ";
            $result['sql'] = $sql;
            $row = $db->getrow($sql,array("name"));
            $result['status'] = "offer";

            if($row) {
                $row['status'] = 'available';
                $row['usertype'] = $userType;
                if($stdesc) {
                    $row['description'] = $stdesc;
                }
                $entity->save("strangerchat",$row);

            } else {
                $data =array();
                $data['name'] = $sessionId;
                $data['usertype'] = $userType;
                $data['status'] = "available";
                if($stdesc) {
                    $data['description'] = $stdesc;
                }
                $entity->save("strangerchat",$data);
            }


            $_SESSION['strangerchatstatus'] = "available";

        }

        echo json_encode($result);

    }

    function action_ajaxPostMessage() {


        if(isset($_GET['room_id']) && isset($_GET['member_id'])) {
            $jsonString = $_POST['data'];
            $json = json_decode($jsonString,1);

            $data = array();
            $data['type'] = $json['action'];
            $data['message'] = $json['data'];
            $roomId = $_GET['room_id'];
            $memberId=  $_GET['member_id'];
            $this->broadcastMessageToRoom($roomId, $memberId,$data);
        }

    }







    function action_ajaxDisconnectChat() {
        if(isset($_REQUEST['room_id']) && $_REQUEST['member_id']) {
                $roomId = $_REQUEST['room_id'];
                $memberId = $_REQUEST['member_id'];
                //if(isset($_SESSION[$roomId][$memberId])) {
                    $sql = "delete from chatroom_room_member_m_m where room_member_id ='".$memberId."' and chatroom_id='".$roomId."'";
                    lib_mysqli::getInstance()->query($sql);
                    $path = lib_config::getInstance()->get("basepath").'cache/rooms/'.$roomId.'/'.$memberId;
                    $cmd = "rm -rf ".$path;
                    shell_exec($cmd);

                    $member = lib_entity::getInstance()->get("room_member", $memberId);
                    $this->broadcastMessageToRoom($roomId, $memberId,array("type"=>"disconnected","message"=>$member['name']." left the chat."));
                    unset($_SESSION[$roomId][$memberId]);
                    $this->sendResponse(200, "");
                //}
        } else {
            $this->sendResponse(401, "");
        }
    }



}

?>