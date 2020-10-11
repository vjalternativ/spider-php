<?php
class chatroomBackendController extends BackendResourceController{

    function action_index() {
        $cmd = 'mkdir -p '.lib_config::getInstance()->get("basepath").'cache/workbench/'.session_id().'/';
        shell_exec($cmd);
        parent::action_index();
    }

    function pullMessages($path) {
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

        return $messages;
    }

    function action_pullNotification() {
        $messages = $this->pullMessages(lib_config::getInstance()->get("basepath").'cache/workbench/'.session_id().'/');
        $this->sendResponse(200, array("messages"=>$messages,"count"=>count($messages)));
    }



}
?>