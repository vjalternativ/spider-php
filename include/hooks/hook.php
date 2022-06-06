<?php

class SystemLogicHook
{

    function beforeSave(&$keyvalue)
    {
        $moduleList = lib_datawrapper::getInstance()->get("module_list");
        if (isset($keyvalue['name']) && isset($moduleList[$keyvalue['hook_table']]['tableinfo']['fields']['alias'])) {
            $db = lib_database::getInstance();
            $alias = (isset($keyvalue['alias']) && $keyvalue['alias']) ? $keyvalue['alias'] : $this->slugify($keyvalue['name']);
            if (isset($keyvalue['isnew']) && $keyvalue['isnew']) {
                $isExist = $db->getrow("select * from " . $keyvalue['hook_table'] . " where deleted=0 and alias ='" . $alias . "' ");
                if ($isExist) {
                    $alias = $alias . '-' . uniqid();
                }
            }
            $keyvalue['alias'] = $alias;
        }
        $entity = lib_entity::getInstance();

        if ($keyvalue['hook_tabletype'] == "user") {
            $keyval = array();

            if ($keyvalue['hook_isnew']) {

                $isExist = $entity->getwhere("user", "user_name='" . $keyvalue['username'] . "'");
                if ($isExist) {
                    die("this account is already registerd.");
                }
                $keyval['user_name'] = $keyvalue['username'];
                $keyval['name'] = $keyvalue['name'];
                $keyval['user_hash'] = md5($keyvalue['password']);
                $keyval['user_type'] = "user";
                $userId = $entity->save("user", $keyval);
                $keyvalue['ownership_id'] = $userId;
            } else {
                if (isset($keyvalue['ownership_id'])) {
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
        $entity = lib_entity::getInstance();
        $globalModuleList = lib_datawrapper::getInstance()->get("module_list");
        if ($keyvalue['hook_tabletype'] == "user") {
            if (isset($keyvalue['deleted']) && $keyvalue['deleted'] == "1" && isset($keyvalue['ownership_id']) && ! empty($keyvalue['ownership_id'])) {
                $data = $entity->get($globalModuleList[$entity->hookTable]['tableinfo']['fields']['ownership_id']['rmodule'], $keyvalue['ownership_id']);
                if ($data) {
                    $data['deleted'] = 1;
                    $entity->save($globalModuleList[$entity->hookTable]['tableinfo']['fields']['ownership_id']['rmodule'], $data);
                }
            }
            if ($keyvalue['hook_isnew']) {
                $entity->setModule("roles");
                $entity->record = $keyvalue['hook_table_id'];
                $entity->addRelationship("roles_user_1_m", $keyvalue['ownership_id']);
            }
        }

        foreach ($keyvalue as $key => $val) {
            $globalRelationshipList = lib_datawrapper::getInstance()->get("relationship_list");
            $globalEntityList = lib_datawrapper::getInstance()->get("entity_list");
            $entity = lib_entity::getInstance();
            if (isset($globalRelationshipList[$key]) && $val) {
                if ($globalRelationshipList[$key]['rtype'] == "1_M") {
                    $secondaryTable = $globalEntityList[$globalRelationshipList[$key]['secondarytable']]['name'];
                    $primaryRecord = $keyvalue['id'];
                    $secondaryRecord = $val;
                    if ($keyvalue['hook_table'] == $secondaryTable) {
                        $primaryRecord = $secondaryRecord;
                        $secondaryRecord = $keyvalue['id'];
                    }
                    $entity->saveRelationship($key, $primaryRecord, $secondaryRecord);
                }
            }
        }
    }

    function workflowAfterSave(&$keyvalue)
    {
        $db = lib_database::getInstance();
        $app_list_strings = lib_datawrapper::getInstance()->get("app_list_strings_list");
        if (isset($app_list_strings['module_list']['workflow'])) {

            $sql = "select * from workflow where deleted=0 and status='Active' and workflow_module='" . $keyvalue['hook_table'] . "'";
            $qry = $db->query($sql, true);

            if ($qry) {
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

    private function replaceAnnotationForWorkFlow($flow, $key, $val)
    {
        $flow['description'] = str_replace("@" . $key, $val, $flow['description']);
        $flow['subject'] = str_replace("@" . $key, $val, $flow['subject']);
        $flow['email_to'] = str_replace("@" . $key, $val, $flow['email_to']);
        return $flow;
    }

    function executeWorkFlowMail($flow, $keyval)
    {
        $entity = lib_entity::getInstance();
        $globalModuleList = lib_datawrapper::getInstance()->get("module_list");
        $smarty = lib_smarty::getSmartyInstance();
        $vjconfig = lib_config::getInstance()->getConfig();
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

        $data['name_detailview_link'] = '<a href="' . $vjconfig['baseurl'] . 'backend/index.php?module=' . $keyval['hook_table'] . '&action=detailview&record=' . $id . '">' . $data['name'] . '</a>';

        foreach ($data as $key => $val) {
            $flow = $this->replaceAnnotationForWorkFlow($flow, $key, $val);
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
            $html = $smarty->fetch($vjconfig['fwbasepath'] . "resources/backend/modules/workflow/tpls/all_fields.tpl");
            $flow['description'] = str_replace("@all_fields", $html, $flow['description']);
        }

        $emailBuffer = array();
        $emailBuffer['name'] = $flow['subject'];
        $emailBuffer['description'] = $flow['description'];
        $emailBuffer['email_to'] = $flow['email_to'];
        $emailBuffer['context'] = "default";
        $entity->save("email_buffer", $emailBuffer);
    }

    public function slugify($text)
    {
        $text = str_replace("(", "", $text);
        $text = str_replace(")", "", $text);

        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
?>