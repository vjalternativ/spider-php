<?php

class CleanUp {
    function execute() {
        $vjconfig = lib_config::getInstance()->getConfig();
        $db = lib_mysqli::getInstance();

        $sql = "select * from csvimporter where deleted = 1 ";

        $rows = $db->fetchRows($sql,array("id"));
        if($rows) {
            foreach($rows as $id=>$name) {
                $sql = "select id from csvchunks where csvimorter='".$id."' limit 50";
                $rows = $db->fetchRows($sql,array("id"),"id");
                if($rows) {

                        $sql = "delete from csvchunks where id IN ('".implode("','",$rows)."')";
                        $db->query($sql);


                }
                $db->query($sql);
                $command = "rm -rf ".$vjconfig['basepath']."tmpuploads/".$id;
                shell_exec($command);


            }
        }



        unlink($vjconfig['basepath']."framework.log");
        unlink($vjconfig['basepath']."service/logs/api/request.log");
    }
}