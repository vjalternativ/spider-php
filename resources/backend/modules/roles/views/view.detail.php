<?php

class rolesViewDetail  extends ViewDetail {

    function display() {

        parent::display() ;

    }


    function processCheckBoxes($row) {

        if($row['module_access']=="yes") {
            $row['module_access'] = '<input type="checkbox" name="module_access[]" value="'.$row['label'].'" checked="checked" />';
        } else {
            $row['module_access'] = '<input type="checkbox" name="module_access[]"  value="'.$row['label'].'"  />';
        }


        return $row;

    }

    function afterDisplay() {
        parent::afterDisplay();
        $db = lib_mysqli::getInstance();
	    $smarty = lib_smarty::getSmartyInstance();
$vjconfig = lib_config::getInstance()->getConfig();

        $sql = "select t.name as label,ri.module_access,ri.list_access,ri.edit_access,ri.delete_access,t.id as module_id from tableinfo t
                left join roles_item ri  on t.name=ri.module_id and ri.role_id = '".$this->record."' and ri.deleted=0 and t.deleted=0
                where  t.deleted=0 and t.tabletype!='relationship'";
        $db->processHook['instance'] = $this;
        $db->processHook['method'] = "processCheckBoxes";

        $rows = $db->fetchRows($sql,array("label"));

        $headers = array();
        $headers['label']['label'] = "Module";
        $headers['module_access']['label'] = "Enabled";
        $headers['list_access']['label'] = "List View";
        $headers['edit_access']['label'] = "Edit View";
        $headers['delete_access']['label'] = "Delete";
        $extraPostFields = array();
        $smarty->assign("headers",$headers);
        $smarty->assign("rows",$rows);
        $smarty->assign("extraPostFields",$extraPostFields);


        $panelbody = $smarty->fetch($vjconfig['fwbasepath'].'include/vjlib/libs/tpls/table.tpl');
        $panelbody .= '<input type="hidden" name="record" value="'.$this->record.'" />';
        $panel = array();
        $panel['type'] = "info";
        $panel['heading'] = "Module Access";
        $panel['body'] = $panelbody;
        $panel['formaction'] = "index.php?module=roles&action=saveAccess";
        $panel['savebutton'] = true;
        $panel['footer'] = true;

        $smarty->assign("panel",$panel);
        echo $smarty->fetch($vjconfig['fwbasepath']."include/vjlib/libs/tpls/panel.tpl");
    }




}