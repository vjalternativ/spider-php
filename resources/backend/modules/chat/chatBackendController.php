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
        $userTypeVsChatUserTypeMap = array();
        $userTypeVsChatUserTypeMap['user'] = "agent";
        
        $this->userTypeVsChatUserTypeMap = array_merge($userTypeVsChatUserTypeMap,array_flip($userTypeVsChatUserTypeMap));
        
    }
    
    function action_index() {
        $this->view = "index";
        
    }
    
    
    
    
    
    function processPackets($rows,$reorder=false) {
        $entity = lib_entity::getInstance();
        $packets = array();
        $opackets = array();
        foreach($rows as $row) {
            $packets[$row['name']][] = $row;
            $row['deleted'] = 1;
            $entity->save("webrtcsignal",$row);
        }
        
        return $rows;
        
        $candidates= $packets['candidate'];
        unset($packets['candidate']);
        
        
        foreach($packets as $ps) {
            foreach($ps as $p) {
                $opackets[] = $p;
            }
        }
        
        foreach ($candidates as $p) {
            
            
            
            $opackets[] = $p;
            
            
        }
        
        
        if($reorder) {
            $opackets = $rows;
        }
        return $opackets;
    }
    
    function action_ajaxReadPackets(){
        $db = lib_mysqli::getInstance();
        $sessionId = session_id();
        $sql = "select * from strangerchat where st_session_id='".$sessionId."' and deleted=0";
        $row = $db->getrow($sql);
        $result = array("packets"=>array(),"name"=>"Friend","status"=>"");
        if($row) {
            
            if($row['usertype']=="agent") {
                
                $sql = "select name  from user where id = '".$row['created_by']."'";
                $uinfo = $db->getrow($sql);
                if($uinfo) {
                    $result['name'] = $uinfo['name'];
                    
                }
            }
            $sql = "select * from webrtcsignal where  deleted=0 and session_id='".$row['name']."' order by date_entered asc";
            $rows = $db->fetchRows($sql);
            if($rows) {
                $result['packets'] = $this->processPackets($rows);
            } else {
              //  $result['status'] = 'invalid.state';
            }
        }
        echo json_encode($result);
        
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
$db = lib_current_user::getEntityInstance();

        
        
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
    
    
    
    function action_ajaxStrangerChatConnectVideo(){
        $db = lib_mysqli::getInstance();
	    $entity = lib_entity::getInstance();
        $result = array('status'=>'no_user_avail','chatId'=>'');
        $sessionId = session_id();
        
        $partnerId = $_REQUEST['partnerChatId'];
        $sql = "select * from strangerchat where status in ('offer','available')  and name !='".$sessionId."' and deleted=0 limit 1";
        if($partnerId!="NA") {
            $sql = "select * from strangerchat where id ='".$partnerId."' and deleted=0 ";
            
        }
        $result['packets'] = array();
        $row = $db->getrow($sql);
        if($row) {
            
            if($row['status']=='available') {
                
                
                $result['status'] = "answer";
                $_SESSION['strangersessionid'] = $row['name'];
                $_SESSION['strangerchatstatus'] = "engaged";
                
                $result['sessionId'] = $sessionId;
                $result['strangersessionid'] = $row['name'];
                
                
                
                $data =array();
                $sql = "select * from strangerchat where  name ='".$sessionId."' and deleted=0 ";
                $data = $db->getrow($sql);
                $data['st_session_id'] = $row['name'];
                $data['name'] = $sessionId;
                $data['status'] = "engaged";
                $entity->save("strangerchat",$data);
                
                $row['status'] = "engaged";
                $row['st_session_id'] = $sessionId;
                $entity->save("strangerchat",$row);
                
                
                $result['status'] = "answer";
                
                
                $_SESSION['strangerchatstatus'] = "engaged";
            } else {
                
                $result['sessionId'] = $sessionId;
                
                $result['status'] = "wait";
                
            }
            
        } else {
            $result['sessionId'] = $sessionId;
            $result['strangersessionid'] = "";
            
            $sql = "select * from strangerchat where  name ='".$sessionId."' and deleted=0 ";
            $result['sql'] = $sql;
            $row = $db->getrow($sql,array("name"));
            $result['status'] = "offer";
            
            if($row) {
                
                $result['status'] = $row['status'];
                $result['strangersessionid'] = $row['st_session_id'];
                $result['id'] = $row['id'];
                $sql = "delete from Calls where callNo = '".$sessionId."'";
                $db->query($sql);
                $sql = "delete from strangerchat where id='".$row['id']."'";
                $db->query($sql);
                
            } else {
                $data =array();
                $data['name'] = $sessionId;
                $data['status'] = "offer";
                
                $id = $entity->save("strangerchat",$data);
                $result['id'] = $id;
            }
            
            
            $_SESSION['strangerchatstatus'] = "offer";
            
        }
        
        echo json_encode($result);
        
    }
    
    function action_ajaxPostMessage() {
        
        $resp = array("status"=>"success");
        
        $entity = lib_entity::getInstance();
        
        $sessionId =  session_id();
        $jsonString = $_POST['data'];
        $json = json_decode($jsonString,1);
        
        $data = array();
        $data['name'] = $json['action'];
        $data['description'] = $json['data'];
        $data['session_id'] = $sessionId;
        
        $entity->save("webrtcsignal",$data);
        
        echo json_encode($resp);
        
        
    }
    
    function action_ajaxhandlesignal() {
        
        $resp = array("status"=>"success");
        
        $entity = lib_entity::getInstance();
        
        $sessionId =  session_id();
        $jsonString = $_POST['data'];
        $json = json_decode($jsonString,1);
        
        $data = array();
        $data['name'] = $json['action'];
        $data['description'] = json_encode($json['data']);
        $data['session_id'] = $sessionId;
        
        $entity->save("webrtcsignal",$data);
        
        echo json_encode($resp);
        
        
    }
    function action_ajaxhandlesignalv1() {
        
        $resp = array("status"=>"success");
        
        $entity = lib_entity::getInstance();
        
        $sessionId =  session_id();
        $jsonString = $_POST['data'];
        $json = json_decode($jsonString,1);
        
        $data = array();
        $data['name'] = $json['type'];
        $data['description'] = $jsonString;
        $data['session_id'] = $sessionId;
        
        $entity->save("webrtcsignal",$data);
        
        echo json_encode($resp);
        
    }
    
    function action_ajaxStrangerChatConnectOld() {
        $servercache = lib_server_cache::getInstance();
$log = lib_logger::getInstance();

        
        $result = array('status'=>'no_user_avail','chatId'=>'');
        $availUserInfo = $servercache->get("availUsersJson");
        $engagedUserInfo = $servercache->get("engagedUserJson");
        $stragerChatInfo = $servercache->get("strangerChatJson");
        if(!$availUserInfo) {
            $availUserInfo = array();
        }
        
        $sessionId = session_id();
        $log->log("GOT CONNECT REQUEST FOR SESION Id ".$sessionId);
        if(isset($_SESSION['availUsersJson']) || isset($engagedUserInfo['data'][$sessionId])) {
            $result['status'] = 'connected';
            $result['chatId'] = $engagedUserInfo['data'][$sessionId]['chatId'];
            $log->log("SESSION IS SET FOR SESION Id ".$sessionId);
        }  else {
            $availUserInfo["data"][$sessionId] = $sessionId;
            
            $partnerSessionId = '';
            $connected = false;
            foreach($availUserInfo['data'] as $tempSessionId) {
                if ($tempSessionId != $sessionId) {
                    $partnerSessionId  = $tempSessionId;
                    $result['status'] = 'connected';
                    $id = uniqid();
                    $result['chatId'] = $id;
                    $_SESSION['availUsersJson']['chatId'] = $id;
                    
                    $engagedUserInfo['data'][$sessionId] = array("chatId"=>$id,"partnerSessionId"=>$partnerSessionId);
                    $engagedUserInfo['data'][$tempSessionId] = array("chatId"=>$id,"partnerSessionId"=>$sessionId);
                    $stragerChatInfo['data'][$id]=array();
                    $stragerChatInfo['data'][$id][$sessionId] = array();
                    $stragerChatInfo['data'][$id][$tempSessionId] = array();
                    $log->log("REMOVING SESSION FROM AVAIL LIST " . $tempSessionId);
                    $log->log("REMOVING SESSION FROM AVAIL LIST " . $sessionId);
                    $connected = true;
                    unset($availUserInfo['data'][$tempSessionId]);
                    unset($availUserInfo['data'][$sessionId]);
                    break;
                }
            }
            if($partnerSessionId=='' && isset($engagedUserInfo['data'][$sessionId])) {
                $result['status'] = 'connected';
                $result['chatId'] = $engagedUserInfo['data'][$sessionId]['chatId'];
            }
            if($connected) {
                $log->log(" AVAIL LIST " . print_r($availUserInfo,1));
            }
            $data = $servercache->set("availUsersJson",$availUserInfo);
            if($data) {
                $log->log(" AVAIL USER JSON " . print_r($data,1));
                
            }
            $servercache->set("engagedUserJson",$engagedUserInfo);
            $servercache->set("strangerChatJson",$stragerChatInfo);
            
        }
        echo json_encode($result);
        die;
    }
    
    function action_ajaxSendMessage() {
        $servercache = lib_server_cache::getInstance();
$log = lib_logger::getInstance();

        $sessionId = session_id();
        $stragerChatInfo = $servercache->get("strangerChatJson");
        //$engagedUserInfo = $servercache->get("engagedUserJson");
        //$partnerId = $engagedUserInfo['data'][$sessionId]['partnerSessionId'];
        $chatId = $_REQUEST['chatId'];
        $msg = $_REQUEST['message'];
        $mid = uniqid();
        $stragerChatInfo['data'][$chatId][$sessionId][]= array("id"=>$mid,"message"=>$msg,"timestamp" => date("Y-m-d H:i:s"));
        // $log->log("SAVING MESSAGE ".$chatId." OF ".$sessionId." DATA".print_r($stragerChatInfo['data'][$chatId][$sessionId],1));
        $servercache->set("strangerChatJson",$stragerChatInfo);
        echo '{"status":"success"}';
        
    }
    
    function action_ajaxGetChatData() {
        $servercache = lib_server_cache::getInstance();

        $stragerChatInfo = $servercache->get("strangerChatJson");
        $engagedUserInfo = $servercache->get("engagedUserJson");
        
        $response = array("chatlog" => array(),"status" => "disconnected");
        $chatId = $_REQUEST['chatId'];
        $sessionId = session_id();
        if(isset($stragerChatInfo['data'][$chatId])) {
            $partnerId = $engagedUserInfo['data'][$sessionId]['partnerSessionId'];
            $result = $stragerChatInfo['data'][$chatId][$partnerId];
            $stragerChatInfo['data'][$chatId][$partnerId] = array();
            $servercache->set("strangerChatJson",$stragerChatInfo);
            $response['chatlog'] = $result;
            $response['status'] = "connected";
        }
        echo json_encode($response);
    }
    
    
    function deleteSignaling($sessionId) {
        $db = lib_mysqli::getInstance();
        $sql = "delete from webrtcsignal where session_id='".$sessionId."' ";
        $db->query($sql);
    }
    
    function action_ajaxDisconnectChat() {
        $entity = lib_entity::getInstance();
        $sessionId = session_id();
        
        $data = $entity->getwhere("strangerchat","name = '".$sessionId."' ");
        if($data) {
            $data['status'] = "disconnected";
            $entity->save("strangerchat",$data);
            
            
            $mdata = array();
            $mdata['name'] = "disconnect";
            $mdata['session_id'] = $sessionId;
            $entity->save("webrtcsignal",$mdata);
            //$this->deleteSignaling($sessionId);
        }
        
        $data = $entity->getwhere("strangerchat","st_session_id = '".$sessionId."' ");
        if($data) {
            $data['status'] = "disconnected";
            $entity->save("strangerchat",$data);
            
            
            //$this->deleteSignaling($data['name']);
        }
        
        $resp = array();
        $resp['status'] = "success";
        echo json_encode($resp);
        
        
        
    }
    
    function action_ajaxDisconnectChatOld() {
        $servercache = lib_server_cache::getInstance();

        
        $stragerChatInfo = $servercache->get("strangerChatJson");
        $engagedUserInfo = $servercache->get("engagedUserJson");
        $availUserInfo = $servercache->get("availUsersJson");
        $sessionId = session_id();
        unset($_SESSION['availUsersJson']);
        if(isset($engagedUserInfo['data']['req.body.sessionId'])) {
            
            $partnerId = $engagedUserInfo['data'][$sessionId]['partnerSessionId'];
            
            $chatId = $engagedUserInfo['data'][$sessionId]['chatId'];
            
            unset($stragerChatInfo['data'][$chatId]);
            unset($engagedUserInfo['data'][$sessionId]);
            unset($engagedUserInfo['data'][$partnerId]);
            
            if(isset($availUserInfo['data'][$sessionId])) {
                unset($availUserInfo['data'][$sessionId]);
            }
            if(isset($availUserInfo['data'][$partnerId])) {
                unset($availUserInfo['data'][$partnerId]);
            }
            
            $servercache->set("availUsersJson",$availUserInfo);
            $servercache->set("strangerChatJson",$stragerChatInfo);
            $servercache->set("engagedUserJson",$engagedUserInfo);
        }
        echo '{"status":"success"}';
        
        
    }
    
    function action_test() {
        $servercache = lib_server_cache::getInstance();

        $stragerChatInfo = $servercache->get("strangerChatJson");
        $engagedUserInfo = $servercache->get("engagedUserJson");
        $availUserInfo = $servercache->get("availUsersJson");
        echo "Stranger chat info : <pre>";print_r($stragerChatInfo);echo "</pre>";
        echo "Engage chat info : <pre>";print_r($engagedUserInfo);echo "</pre>";
        echo "Avail chat info : <pre>";print_r($availUserInfo);echo "</pre>";
        die;
    }
    
    function action_storeSDP() {
        $db = lib_mysqli::getInstance();
        $type = $_POST['type'];
        $sdp = $_POST['sdp'];
        $callNo = session_id();
        if ($type=="answer") { //only the responder will have a valid callNo
            $callNo = $_POST['stsessionId'];
            $db->query("UPDATE Calls SET responderSdp='".$sdp."' WHERE callNo='".$callNo."'");
        }
        else {
            $db->query("INSERT IGNORE INTO Calls VALUES('".$callNo."', '".$sdp."', '')");
            
        }
        echo $callNo;
        
    }
    
    function action_fetchSDP() {
        ini_set("display_errors",1);
        $db = lib_mysqli::getInstance();
        $callNo = $_GET["callNo"];
        $type = $_GET['calltype'];
        $sdp = "";
        if ($type == "offer") // caller has +ve callNo
        {
            $row = $db->getrow("SELECT responderSdp FROM Calls WHERE callNo='".$callNo."'");
            $sdp  =$row['responderSdp'];
        }
        else
        {
            $row = $db->getrow("SELECT callerSdp FROM Calls WHERE callNo='".$callNo."'");
            $sdp  = $row['callerSdp'];
        }
        echo $sdp;
    }
    
    function action_poll() {
        $db = lib_mysqli::getInstance();
	    $entity = lib_entity::getInstance();
        $sessionId = session_id();
        
        
        
        $data =array();
        $sql = "select * from strangerchat where  name ='".$sessionId."' and deleted=0 and status='offer' ";
        $data = $db->getrow($sql);
        if($data) {
            $data['st_session_id'] = "";
            $data['name'] = $sessionId;
            $data['status'] = "available";
            $entity->save("strangerchat",$data);
        }
        
        $sql = "select * from strangerchat where  name ='".$sessionId."' and deleted=0 and status='engaged' ";
        
        $row = $db->getrow($sql);
        $resp = array('status'=>"wait");
        
        if($row) {
            $sql ="SELECT responderSdp FROM Calls WHERE callNo='".$sessionId."'";
            $row = $db->getrow($sql);
            if($row && !empty($row['responderSdp'])) {
                $resp['sdp'] = $row['responderSdp'];
                $resp['status'] = "done";
                
            }
        }
        
        echo json_encode($resp);
        
        
    }
}

?>