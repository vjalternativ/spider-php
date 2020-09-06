<?php

class SystemLogicHook
{

    function beforeSave(&$keyvalue)
    {
        global $entity;
        if ($keyvalue['hook_tabletype'] == "user") {
            $keyval = array();

            if ($keyvalue['hook_isnew']) {

                $isExist = $entity->getwhere("user","user_name='".$keyvalue['username']."'");
                if($isExist) {
                    die("this account is already registerd.");
                }
                $keyval['user_name'] = $keyvalue['username'];
                $keyval['name'] = $keyvalue['name'];
                $keyval['user_hash'] = md5($keyvalue['password']);
                $keyval['user_type'] = "user";
                $userId = $entity->save("user", $keyval);
                $keyvalue['ownership_id'] = $userId;
            } else {
                if(isset($keyvalue['ownership_id'])) {
                    $keyval['id'] = $keyvalue['ownership_id'];
                    $keyval['name'] = $keyvalue['name'];
                    $keyval['user_name'] = $keyvalue['username'];
                    $keyval['user_hash'] = md5($keyvalue['password']);
                    $entity->save("user", $keyval);
                }
            }
        }
    }

    function afterSave(&$keyvalue)
    {
        global $entity, $globalModuleList;
        if ($keyvalue['hook_tabletype'] == "user") {
            if (isset($keyvalue['deleted']) && $keyvalue['deleted'] == "1" && isset($keyvalue['ownership_id']) && ! empty($keyvalue['ownership_id'])) {
                $data = $entity->get($globalModuleList[$entity->hookTable]['tableinfo']['fields']['ownership_id']['rmodule'], $keyvalue['ownership_id']);
                if ($data) {
                    $data['deleted'] = 1;
                    $entity->save($globalModuleList[$entity->hookTable]['tableinfo']['fields']['ownership_id']['rmodule'], $data);
                }
            }
            if ($keyvalue['hook_isnew']) {
                $entity->record = $keyvalue['hook_table_id'];
                $entity->addRelationship("roles_user_1_m", $keyvalue['ownership_id']);
            }
        }

        foreach($keyvalue as $key=>$val) {
            global $globalRelationshipList,$globalEntityList,$entity;
            if(isset($globalRelationshipList[$key]) && $val) {
                if($globalRelationshipList[$key]['rtype']=="1_M") {
                    $secondaryTable = $globalEntityList[$globalRelationshipList[$key]['secondarytable']]['name'];
                    $primaryRecord = $keyvalue['id'];
                    $secondaryRecord = $val;
                    if($keyvalue['hook_table'] == $secondaryTable) {
                        $primaryRecord = $secondaryRecord;
                        $secondaryRecord = $keyvalue['id'];
                    }
                    $entity->saveRelationship($key, $primaryRecord,$secondaryRecord);
                }
            }
        }


    }

    function workflowAfterSave(&$keyvalue)
    {
        global $db, $globalModuleList;

        if (isset($globalModuleList['workflow'])) {




            $sql = "select * from workflow where deleted=0 and status='Active' and workflow_module='" . $keyvalue['hook_table_id'] . "'";

            $qry = $db->query($sql,true);

            if($qry) {
                $rows = $db->fetchRows($sql, array(
                    "id"
                ));
                foreach ($rows as $row) {
                    if ($row['is_expr']) {}

                    if ($row['runs_on'] == "new" && $keyvalue['hook_isnew']) {
                        $this->executeWorkFlowMail($row, $keyvalue);
                    }
                }
            }


        }
    }

    function executeWorkFlowMail($flow, $keyval)
    {
        global $entity, $globalModuleList, $smarty, $vjconfig;
        $fields = $globalModuleList[$keyval['hook_table']]['tableinfo']['fields'];

        $data = $entity->get($keyval['hook_table'], $keyval['id']);
        $id = $data['id'];
        unset($data['id']);
        unset($data['deleted']);
        unset($data['session_id']);

        foreach ($fields as $key => $field) {
            if ($field['type'] == "relate" || $field['type'] == "file" || $field['type'] == "nondb") {
                unset($data[$key]);
            }
        }

        $rows = array();
        $rowcounter = 0;
        $counter = 0;

        foreach ($data as $key => $val) {

            if ($key == "name") {
                $val = '<a href="' . $vjconfig['baseurl'] . 'index.php?module=' . $keyval['hook_table'] . '&action=detailview&record=' . $id . '">' . $val . '</a>';
            }

            $flow['description'] = str_replace("@" . $key, $val, $flow['description']);
            $flow['subject'] = str_replace("@" . $key, $val, $flow['subject']);

            $cell = array();
            $cell['heading'] = strtoupper($key);
            $cell['value'] = $val;

            $rows[$rowcounter][] = $cell;

            if (isset($fields[$key])) {
                $field = $fields[$key];
                if ($field['type'] == "text") {
                    $rowcounter ++;
                    $counter = 0;
                    continue;
                }
            }
            $counter ++;
            if ($counter % 2 == 0) {
                $counter = 0;
                $rowcounter ++;
            }
        }

        if (strpos($flow['description'], "@all_fields") !== false) {
            $smarty->assign("rows", $rows);
            $html = $smarty->fetch($vjconfig['fwbasepath']."resources/backend/modules/workflow/tpls/all_fields.tpl");
            $flow['description'] = str_replace("@all_fields", $html, $flow['description']);
        }

        $emailBuffer = array();
        $emailBuffer['name'] = $flow['subject'];
        $emailBuffer['description'] = $flow['description'];
        $emailBuffer['email_to'] = $flow['email_to'];
        $emailBuffer['context'] = "68b0d354-4517-0b95-2543-5bf59756d353";
        $entity->save("email_buffer", $emailBuffer);
    }
}
?>