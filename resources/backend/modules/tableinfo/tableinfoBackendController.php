<?php
require_once lib_config::getInstance()->get('fwbasepath') . 'libs/lib_bootstrap.php';

class tableinfoBackendController extends BackendResourceController
{

    function __construct()
    {
        $this->nonauth['updateschema'] = array();
        $this->nonauth['ajaxrelatemodal'] = array();
        $this->nonauth['ajaxRemoveRelationship'] = array();
        $this->nonauth['deleteRecord'] = array();
        parent::__construct();
    }

    function action_editview()
    {
        $this->view = 'edit';
    }

    function action_save()
    {
        $entity = lib_entity::getInstance();
        if (empty($_POST['name'])) {
            die("table name should not be empty");
        }
        $table = $_POST['name'];
        $tbinfo = $entity->getwhere("tableinfo", "name='" . $table . "'");
        if ($tbinfo) {
            foreach ($_POST as $key => $val) {
                if (isset($tbinfo[$key])) {
                    $tbinfo[$key] = $val;
                }
            }
            $entity->save("tableinfo", $tbinfo);
        } else {
            $type = $_POST['tabletype'];
            $entity->createEntity($table, array(
                "type" => $type
            ));
        }

        lib_util::redirect("tableinfo");
    }

    function action_dropdowneditor()
    {
        $this->view = "dropdowneditor";
    }

    function action_ajaxrelatemodal()
    {
        $db = lib_database::getInstance();
        $globalRelationshipList = lib_datawrapper::getInstance()->get("relationship_list");
        $globalEntityList = lib_datawrapper::getInstance()->get("entity_list");

        $module = $_REQUEST['rmodule'];
        $value = $_REQUEST['value'];
        $field = $_REQUEST['field'];
        $sql = "select " . $module . ".* from " . $module;

        $parentId = "";
        $relate_relationship = "";
        if (isset($_REQUEST['parent_id']) && isset($_REQUEST['relate_relationship'])) {
            $parentId = $_REQUEST['parent_id'];
            $relate_relationship = $_REQUEST['relate_relationship'];
            $relData = $globalRelationshipList[$relate_relationship];
            $sql .= " INNER JOIN " . $relate_relationship . " ON " . $module . ".id=" . $relate_relationship . "." . $module . "_id and " . $relate_relationship . ".deleted=0 and " . $relate_relationship . "." . $globalEntityList[$relData['primarytable']]['name'] . "_id='" . $parentId . "'";
        }

        $sql .= " where " . $module . ".deleted=0 and  " . $module . ".name like '%" . $value . "%' limit 10";

        $process = array();
        $process['id'] = array(
            "tag" => "input",
            '',
            'attr' => array(
                "type" => "radio",
                "name" => "dependent_records",
                "onclick" => "setrelate('" . $field . "')",
                "data-relate-name" => '',
                "class" => 'relate_field_id'
            ),
            "isdualtag" => false
        );
        $rows = $db->getrows($sql, 'id', false, false, $process);

        $bs = lib_bootstrap::getInstance();
        $params = array();
        $params['headers'] = array(
            "id",
            "name"
        );
        $table = $bs->generateTable($rows, $params);
        echo $table;
        die();
    }

    function action_ajaxeditoption()
    {
        $app_list_strings = lib_datawrapper::getInstance()->get("app_list_strings_list");

        $bs = lib_bootstrap::getInstance();

        $list = $app_list_strings[$_REQUEST['list']];

        $rows = array();
        $counter = 0;
        foreach ($list as $key => $value) {
            $row = array();

            $keyelem = lib_util::getelement('input', '', array(
                'value' => $key,
                'type' => 'text',
                'class' => 'form-control',
                'name' => 'key[]'
            ), false);
            $valelem = lib_util::getelement('input', '', array(
                'value' => $value,
                'type' => 'text',
                'class' => 'form-control',
                'name' => 'val[]'
            ), false);
            $hiddenlistelem = lib_util::getelement('input', '', array(
                'value' => $_REQUEST['list'],
                'type' => 'hidden',
                'class' => 'form-control',
                'name' => 'list'
            ), false);

            $row['key'] = $keyelem;
            $row['value'] = $valelem;
            $row['action'] = lib_util::getelement('button', '+', array(
                'type' => 'button',
                'class' => 'btn btn-primary btn-sm',
                'onclick' => "newoptionrow()"
            )) . '&nbsp;' . getelement('button', 'x', array(
                'type' => 'button',
                'class' => 'btn btn-danger btn-sm',
                'onclick' => "deleteoptionrow(" . $counter . ")"
            ));
            $rows[] = $row;
            $counter ++;
        }

        $params = array();
        $params['tbid'] = 'opt';
        $params['headers'] = array(
            'key',
            'value',
            'action'
        );
        $table = $bs->generateTable($rows, $params);
        echo $hiddenlistelem . $table;

        die();
    }

    function action_ajaxnewoptionrow()
    {
        $count = $_REQUEST['count'];
        $keyelem = lib_util::getelement('input', '', array(
            'value' => '',
            'type' => 'text',
            'class' => 'form-control',
            'name' => 'key[]'
        ), false);
        $valelem = lib_util::getelement('input', '', array(
            'value' => '',
            'type' => 'text',
            'class' => 'form-control',
            'name' => 'val[]'
        ), false);

        $action = lib_util::getelement('button', '+', array(
            'type' => 'button',
            'class' => 'btn btn-primary btn-sm',
            'onclick' => "newoptionrow()"
        )) . '&nbsp;' . getelement('button', 'x', array(
            'type' => 'button',
            'class' => 'btn btn-danger btn-sm',
            'onclick' => "deleteoptionrow(" . $count . ")"
        ));

        $td = lib_util::getelement('td', $keyelem);
        $td .= lib_util::getelement('td', $valelem);
        $td .= lib_util::getelement('td', $action);

        $tr = lib_util::getelement('tr', $td, array(
            "class" => 'opt-row',
            'id' => 'opt-' + $count
        ));

        echo $tr;
        die();
    }

    function action_saveoption()
    {
        $app_list_strings = lib_datawrapper::getInstance()->get("app_list_strings_list");

        $list = $_POST['list'];

        $keys = $_REQUEST['key'];
        $vals = $_REQUEST['val'];

        $array = array();
        $counter = 0;
        foreach ($keys as $key) {
            $array[$key] = $vals[$counter];
            $counter ++;
        }
        $app_list_strings[$list] = $array;
        $filepath = 'include/language/lang.php';
        file_put_contents($filepath, '<?php $app_list_strings = ' . var_export($app_list_strings, true) . ';');
        lib_util::redirect('tableinfo', 'dropdowneditor');
    }

    function action_addfield()
    {
        $db = lib_database::getInstance();
        $entity = lib_entity::getInstance();

        $fieldType = $_REQUEST['field-type'];

        $_REQUEST['field-name'] = trim($_REQUEST['field-name']);
        $temp = array(
            "name" => $_REQUEST['field-name'],
            'type' => $_REQUEST['field-type'],
            "table" => "primary"
        );
        if ($temp['type'] == "relate" || $temp['type'] == "file") {
            $fieldType = "char";
            $_REQUEST['field-len'] = '36';
            $temp['rmodule'] = $_REQUEST['rmodule'];
        } else if ($temp['type'] == 'dependent_relate') {
            $fieldType = "char";
            $_REQUEST['field-len'] = '36';

            $temp['rmodule'] = $_REQUEST['rmodule'];
            $temp['dependent_relate_field'] = $_REQUEST['dependent_relate_field'];
            $temp['dependent_relate_field'] = $_REQUEST['dependent_relate_field'];
            $temp['relate_relationship'] = $_REQUEST['relate_relationship'];
        } else if ($temp['type'] == "checkbox") {
            $fieldType = "int";
        } else if ($temp['type'] == "enum") {
            $fieldType = "varchar";
            $_REQUEST['field-len'] = "255";
            $temp['options'] = $_REQUEST['field-options'];
        } else if ($temp['type'] == "multienum") {
            $fieldType = "text";
            $temp['options'] = $_REQUEST['field-options'];
            if (isset($_REQUEST['relate_relationship'])) {
                if ($_REQUEST['relate_relationship']) {
                    unset($temp['options']);
                    $temp['relationship'] = $_REQUEST['relate_relationship'];
                }
            }
        }

        $postSql = "";
        if ($_REQUEST['field-len'] != "") {
            $temp['len'] = $_REQUEST['field-len'];
            $postSql .= " (" . $_REQUEST['field-len'] . ") ";
        }

        if ($_REQUEST['field-notnull'] == 'true') {
            $postSql .= " NOT NULL ";
            $temp['notnull'] = 1;
        }

        if ($_REQUEST['field-default'] != '') {

            $default = "'" . $_REQUEST['field-default'] . "'";

            $postSql .= " DEFAULT " . $default;
            $temp['default'] = $_REQUEST['field-default'];
        }

        if (! empty($_REQUEST['field_index'])) {
            $temp['field_index'] = $_REQUEST['field_index'];
        }

        $table = $_REQUEST['tableinfo-name'];

        $formodule = $_REQUEST['formodule'];

        if ($formodule == "tableinfo") {

            $sql = "ALTER TABLE " . $table . " ADD COLUMN " . $_REQUEST['field-name'] . " " . $fieldType . " ";
            $sql .= " " . $postSql;

            $db->query($sql);
        }

        $formodulerecord = $_REQUEST['formodulerecord'];
        $tbinfo = $entity->get($formodule, $formodulerecord);
        $desc = json_decode(base64_decode($tbinfo['description']), 1);
        $desc['fields'][$_REQUEST['field-name']] = $temp;

        $descstring = base64_encode(json_encode($desc));
        $tbinfo['description'] = $descstring;

        $entity->save($formodule, $tbinfo);
        lib_util::redirect($formodule, 'detailview', array(
            'record' => $formodulerecord
        ));
    }

    function action_saverelationship()
    {
        $entity = lib_entity::getInstance();
        $primarymod = $_REQUEST['primarymod'];
        $secodaryid = $_REQUEST['secondarytable'];
        $secondaryinfo = $entity->get('tableinfo', $secodaryid);
        $type = $_REQUEST['rtype'];
        $label = $_REQUEST['lhs_module_rname'];
        $secondlabel = $_REQUEST['rhs_module_rname'];
        $entity->createRelationship($primarymod, $secondaryinfo['name'], $type, $label, $secondlabel);
        lib_util::redirect('tableinfo', 'detailview', array(
            'record' => $_REQUEST['record']
        ));
    }

    function action_ajaxSaveListViewLayout()
    {
        $entity = lib_entity::getInstance();
        $db = lib_database::getInstance();
        $globalEntityList = lib_datawrapper::getInstance()->get("entity_list");

        $id = $_REQUEST['id'];
        $colorder = $_REQUEST['colorder'];
        $view = $_REQUEST['view'];
        $info = $entity->get('tableinfo', $id);
        $layout = json_decode(base64_decode($info['description']), 1);

        $sql = "select * from relationships where secondarytable = '" . $id . "' and deleted=0 and rtype='1_M'";
        $rlist = $db->fetchRows($sql);

        foreach ($rlist as $r) {
            $layout['fields'][$r['name']]['name'] = $r['name'];
            $layout['fields'][$r['name']]['type'] = 'nondb';
            $layout['fields'][$r['name']]['rmodule'] = $globalEntityList[$r['primarytable']]['name'];
            $layout['fields'][$r['name']]['label'] = $r['primarytable_name'];
        }

        $listviewlayout = array();

        foreach ($colorder as $key => $col) {
            // $listviewlayout[$_REQUEST['field'][$key]] = $layout['fields'][$_REQUEST['field'][$key]];
            $listviewlayout[$_REQUEST['field'][$key]] = $_REQUEST['field'][$key];
            $colorder[$key] = $col;
        }

        $layout['metadata'][$view] = $listviewlayout;
        $info['listviewdef'] = json_encode($listviewlayout);
        $entity->save("tableinfo", $info);
        echo "success";
    }

    function action_ajaxSaveLayout()
    {
        $entity = lib_entity::getInstance();
        $viewtype = $_REQUEST['type'];

        $formodule = $_REQUEST['formodule'];

        $formoduleRecord = $_REQUEST['formodulerecord'];
        $info = $entity->get($formodule, $formoduleRecord);
        $metainfo = array();
        $rowindex = - 1;
        $totalgrid = 0;

        if (isset($_REQUEST['layout-field-type'])) {
            foreach ($_REQUEST['layout-field-type'] as $key => $type) {
                $type = trim($type);
                if ($type == "row") {
                    $rowindex ++;
                } else if ($type == "") {
                    $type = "row";
                }
                $grid = $_REQUEST['layout-gridsize'][$key];
                if ($totalgrid > 0 && $grid == "12") {
                    // $rowindex ++;
                    $totalgrid = 0;
                }
                $metainfo[$rowindex]['type'] = $type;
                if ($type == 'hr') {
                    $metainfo[$rowindex]['label'] = $_REQUEST['layout-field-label'][$key];
                } else if (isset($_REQUEST['layout-field'][$key])) {
                    $field = $_REQUEST['layout-field'][$key];
                    $fieldinfo = array(
                        'field' => array(
                            "name" => $field
                        ),
                        'gridsize' => $grid
                    );
                    if (isset($_REQUEST['layout-' . $field . '-isreq'])) {
                        $fieldinfo['r'] = 1;
                    }
                    $metainfo[$rowindex]['fields'][] = $fieldinfo;
                }
                $totalgrid += $grid;
                if ($totalgrid == "12") {
                    $totalgrid = 0;
                    // $rowindex ++;
                }
            }
        }

        $info[$viewtype . 'def'] = json_encode($metainfo);

        $entity->save($formodule, $info);
        die();
    }

    function action_deleteRecord()
    {
        $entity = lib_entity::getInstance();
        $mod = $_REQUEST['mod'];
        $id = $_REQUEST['id'];
        $info = $entity->get($mod, $id);
        $info['deleted'] = 1;
        $entity->save($mod, $info);
        die("done");
    }

    function action_ajaxFetchSubpanleList()
    {
        $entity = lib_entity::getInstance();
        $smarty = lib_smarty::getSmartyInstance();
        $vjconfig = lib_config::getInstance()->getConfig();
        $globalRelationshipList = lib_datawrapper::getInstance()->get("relationship_list");
        $globalRelationshipEntityList = lib_datawrapper::getInstance()->get("relationship_entity_list");

        try {
            $rtable = $_REQUEST['rtable'];
            $relname = $_REQUEST['relname'];
            $relationshipEntity = $globalRelationshipList[$relname];
            $sql = false;
            $proceed = true;

            if (isset($_REQUEST['parent_record'])) {
                $parentRecord = $_REQUEST['parent_record'];
                if ($relationshipEntity['parent_relationship'] && $relationshipEntity['target_relationship']) {

                    $parentRelationship = $globalRelationshipEntityList[$relationshipEntity['parent_relationship']];
                    $targetRelationship = $globalRelationshipEntityList[$relationshipEntity['target_relationship']];

                    $globalEntityList = lib_datawrapper::getInstance()->get("entity_list");

                    $db = lib_database::getInstance();
                    $sql = "select * from " . $parentRelationship['name'] . " where deleted=0 and " . $globalEntityList[$parentRelationship['secondarytable']]['name'] . "_id='" . $parentRecord . "'";

                    $primaryField = $globalEntityList[$parentRelationship['primarytable']]['name'] . "_id";

                    $rows = $db->fetchRows($sql, array(
                        $primaryField
                    ), $primaryField);

                    if ($rows) {
                        $sql = "select * from " . $targetRelationship['name'] . " where deleted=0 and " . $primaryField . " IN ('" . implode("','", $rows) . "') ";

                        $primaryTable = $globalEntityList[$targetRelationship['secondarytable']]['name'];
                        $primaryField = $primaryTable . "_id";
                        $rows = $db->fetchRows($sql, array(
                            $primaryField
                        ), $primaryField);
                        if ($rows) {
                            $sql = "select * from " . $primaryTable . " where deleted=0 and id in ('" . implode("','", $rows) . "') ";
                        } else {
                            $proceed = false;
                        }
                    } else {
                        $proceed = false;
                    }
                } else {
                    # #todo entity list view handling

                    $sql = "select t.* from " . $relname . " r inner join " . $rtable . " t  on r." . $relationshipEntity['secondary_table_text'] . "_id=t.id  and r." . $relationshipEntity['primary_table_text'] . "_id!='" . $parentRecord . "' and t.deleted=0 ";
                    $proceed = true;
                }
            }

            if ($proceed) {

                $rows = $entity->results($rtable, $sql);
            } else {
                $rows = arrray();
            }

            $smarty->assign("headers", $entity->listview['metadata']);
            $smarty->assign("rows", $rows['data']);
            $extraPreFields = array();
            $extraPreFields['id']['data']['html'] = '<input type="checkbox" name="recordList[]" value="REPLACE_KEY" />';
            $extraPreFields['id']['header']['html'] = '';
            $smarty->assign("extraPreFields", $extraPreFields);
            echo '<input type="hidden" name="relname" value="' . $relname . '" />';
            echo $smarty->fetch($vjconfig['fwbasepath'] . "include/vjlib/libs/tpls/table.tpl");
        } catch (Exception $e) {
            die("Invalid Input parameters");
        }

        die();
    }

    function action_ajaxRemoveRelationship()
    {
        $record = $_REQUEST['record'];
        $relname = $_REQUEST['relname'];
        $relId = $_REQUEST['relid'];
        $entity = lib_entity::getInstance();
        $entity->record = $record;
        $entity->removeRelationship($relname, $relId);
        die("success");
    }

    function action_deleteFields()
    {
        $entity = lib_entity::getInstance();
        $db = lib_database::getInstance();

        $id = $_REQUEST['module_id'];
        $fields = isset($_REQUEST['field']) ? $_REQUEST['field'] : array();

        $formodule = $_REQUEST['formodule'];
        $formodulerecord = $_REQUEST['formodulerecord'];

        $data = $entity->get($formodule, $formodulerecord);

        $desc = json_decode(base64_decode($data['description']), 1);

        foreach (array_keys($desc['fields']) as $field) {
            if (in_array($field, $entity->defaultFields)) {
                continue;
            }
            if (in_array($field, $fields)) {
                continue;
            }

            unset($desc['fields'][$field]);

            if ($formodule == "tableinfo") {
                $cols = $db->getfields($data['name']);
                if (in_array($field, $cols)) {
                    $sql = "alter table " . $data['name'] . " drop " . $field;
                    $db->query($sql);
                }
            }
        }
        $data['description'] = base64_encode(json_encode($desc));
        $entity->save($formodule, $data);
        lib_util::redirect($formodule, "detailview", array(
            "record" => $formodulerecord
        ));
    }

    function action_deleteRelationship()
    {
        $db = lib_database::getInstance();

        $id = $_REQUEST['module_id'];
        $relationshipIds = isset($_REQUEST['relationship_ids']) ? $_REQUEST['relationship_ids'] : array();

        $sql = "select r.*,t.name as secondarytablename from relationships r left join tableinfo t on r.secondarytable=t.id	where r.primarytable ='" . $id . "' and r.deleted=0";

        $data = $db->fetchRows($sql, array(
            "id"
        ));
        foreach ($data as $row) {

            if (in_array($row['id'], $relationshipIds)) {
                continue;
            }
            $sql = "drop table " . $row['name'];
            $db->query($sql, true);

            $sql = "delete from relationships where id='" . $row['id'] . "'";
            $db->query($sql);

            $sql = "delete from tableinfo where name='" . $row['name'] . "'";
            $db->query($sql);
        }

        lib_util::redirect("tableinfo", "detailview", array(
            "record" => $id
        ));
    }

    function action_dowloadschema()
    {
        $db = lib_database::getInstance();

        $sql = "select * from tableinfo where deleted=0";
        $tableinfo = $db->fetchRows($sql, array(
            "name"
        ));
        foreach ($tableinfo as $id => $table) {

            $sql = "show create table " . $table['name'];
            $schema = $db->fetchRows($sql, array(
                "Table"
            ), "Create Table");

            $tableinfo[$id]['schema'] = base64_encode($schema[$table['name']]);
        }

        $sql = "select * from relationships where deleted=0";
        $relationships = $db->fetchRows($sql, array(
            "name"
        ));

        $data = array();
        $data['tableinfo'] = $tableinfo;

        $data['relationships'] = $relationships;
        file_put_contents("schemajson/schema.json", json_encode($data));
    }

    function action_updateschema()
    {
        $db = lib_database::getInstance();
        $entity = lib_entity::getInstance();
        $json = file_get_contents("schemajson/schema.json");

        $data = json_decode($json, 1);

        $sql = "select * from tableinfo where deleted=0";
        $tableinfo = $db->fetchRows($sql, array(
            "name"
        ));
        foreach (array_keys($tableinfo) as $id) {
            unset($data['tableinfo'][$id]);
        }

        $sql = "select * from relationships where deleted=0";
        $relationships = $db->fetchRows($sql, array(
            "name"
        ));

        foreach (array_keys($relationships) as $id) {
            unset($data['relationships'][$id]);
        }

        foreach ($data['tableinfo'] as $tableinfo) {
            $sql = base64_decode($tableinfo['schema']);
            $db->query($sql);

            $id = $tableinfo['id'];

            unset($tableinfo['id']);
            unset($tableinfo['schema']);
            unset($tableinfo['date_entered']);
            unset($tableinfo['date_modified']);

            $entity->save("tableinfo", $tableinfo);

            $sql = "update tableinfo set id= '" . $id . "' where name ='" . $tableinfo['name'] . "' and deleted=0 and date(date_entered)=CURDATE()";
            $db->query($sql);
        }

        foreach ($data['relationships'] as $relationships) {

            unset($relationships['id']);
            unset($relationships['date_entered']);
            unset($relationships['date_modified']);

            $entity->save("relationships", $relationships);
        }
    }

    function action_importdata()
    {
        ini_set("display_errors", 1);
        $db = lib_database::getInstance();
        $entity = lib_entity::getInstance();
        $module = $_POST['importmodule'];
        $_SESSION['reqresp']['status'] = "success";
        $_SESSION['reqresp']['message'] = "Imported Sucessfully records : ";

        $cols = $db->getfields($module);
        $headerarray = array();
        $process = false;
        $ob = null;
        $failed = array();
        if (file_exists("custom/modules/" . $module . "/processRecord.php")) {
            require_once "custom/modules/" . $module . "/processRecord.php";
            $process = true;
            $class = $module . "ProcessRecord";
            $ob = new $class();
        }
        if ($cols && isset($_FILES['exportfile']) && $_FILES['exportfile']['error'] == '0') {
            $tmp = $_FILES['exportfile']['tmp_name'];

            $file = fopen($tmp, "r");
            $counter = 0;
            $rcounter = 0;
            while (! feof($file)) {
                $data = fgetcsv($file);
                if ($counter == 0) {
                    foreach ($data as $hkey => $hval) {
                        $data[$hkey] = strtolower($hval);
                    }
                    $headers = array_flip($data);
                    foreach ($headers as $hkey => $hval) {
                        if (isset($cols[$hkey])) {
                            $headerarray[$hkey] = $hval;
                        }
                    }
                } else {

                    $pdata = array();

                    foreach ($headerarray as $hkey => $hval) {

                        $pdata[$hkey] = trim($data[$hval]);
                    }
                    if ($process) {
                        $pdata = $ob->process($pdata);
                    }

                    if ($pdata) {
                        $rcounter ++;
                        if (isset($pdata['name'])) {
                            $sql = "select id from page_component where deleted=0 and name='" . $pdata['name'] . "'";
                            $data = $db->getrow($sql);
                            if ($data) {
                                $pdata['id'] = $data['id'];
                            }
                        }
                        $entity->save("page_component", $pdata);
                    } else {
                        $failed[$counter] = implode(",", $data);
                    }
                }

                $counter ++;
            }

            fclose($file);
            $_SESSION['reqresp']['message'] .= $rcounter;
            $_SESSION['reqresp']['data'] = $failed;
        } else {
            $_SESSION['reqresp']['status'] = "danger";
            $_SESSION['reqresp']['message'] = "Failed to import.";
        }

        header("location:index.php?module=" . $module . "&process=1");
    }

    function action_import()
    {
        ini_set("display_errors", 1);
        $db = lib_database::getInstance();
        $entity = lib_entity::getInstance();
        $vjconfig = lib_config::getInstance()->getConfig();

        $module = $_POST['importmodule'];
        $_SESSION['reqresp']['status'] = "success";
        $_SESSION['reqresp']['message'] = "Imported Sucessfully records : ";

        $cols = $db->getfields($module);
        $headerarray = array();
        $process = false;
        $ob = null;
        $failed = array();
        if (file_exists("custom/modules/" . $module . "/processRecord.php")) {
            require_once "custom/modules/" . $module . "/processRecord.php";
            $process = true;
            $class = $module . "ProcessRecord";
            $ob = new $class();
        }
        if ($cols && isset($_FILES['exportfile']) && $_FILES['exportfile']['error'] == '0') {
            $tmp = $_FILES['exportfile']['tmp_name'];

            $data = array();
            $name = "CSV-" . date("Y-m-d-H:i:s");
            $data['name'] = $name;
            $data['module'] = $module;
            $id = $entity->save("csvimporter", $data);
            $command = "cd  " . $vjconfig['basepath'] . "tmpuploads;mkdir " . $id;
            $x = shell_exec($command);

            $command = 'split -a 4 -d -l 500 ' . $tmp . ' ' . $vjconfig['basepath'] . 'tmpuploads/' . $id . '/part.';
            $x = shell_exec($command);
            $x = shell_exec("cd  " . $vjconfig['basepath'] . 'tmpuploads/' . $id . "; ls -ltrh|grep part|awk '{print $9}'");
            $files = explode("\n", $x);
            array_pop($files);

            $_SESSION['reqresp']['message'] = "File uploaded successully";

            $file = fopen($tmp, "r");
            $counter = 0;
            while (! feof($file)) {
                $data = fgetcsv($file);
                if ($counter == 0) {
                    foreach ($data as $hkey => $hval) {
                        $hval = trim($hval);
                        $data[$hkey] = strtolower($hval);
                    }
                    $headers = array_flip($data);
                    foreach ($headers as $hkey => $hval) {
                        if (isset($cols[$hkey])) {
                            $headerarray[$hkey] = $hval;
                        }
                    }
                    break;
                }

                $counter ++;
            }

            fclose($file);

            $data['id'] = $id;
            $data['headers'] = json_encode($headerarray);
            $data['chunks'] = count($files);
            $entity->save("csvimporter", $data);

            $_SESSION['reqresp']['data'] = $failed;
        } else {
            $_SESSION['reqresp']['status'] = "danger";
            $_SESSION['reqresp']['message'] = "Failed to import.";
        }

        // header("location:index.php?module=".$module."&process=1");
    }

    function action_updateAlias()
    {
        require_once 'spider-php/include/hooks/hook.php';
        $db = lib_database::getInstance();
        $entity = lib_entity::getInstance();
        $mod = $_REQUEST['mod'];
        $hook = new SystemLogicHook();
        $sql = "select * from " . $mod . " where deleted=0";
        $rows = $db->fetchRows($sql, array(
            'id'
        ));

        $aliasVsIdList = array();
        foreach ($rows as $row) {

            if (! array_key_exists("alias", $row)) {
                break;
            }

            $row['alias'] = $hook->slugify($row['name']);

            $alias = $row['alias'];
            if (isset($aliasVsIdList[$alias])) {
                $row['alias'] = $alias . '-' . count($aliasVsIdList[$alias]);
            }

            $aliasVsIdList[$alias][$row['id']] = $row['id'];

            $entity->save($mod, $row);
        }
    }

    function action_migratetable()
    {
        return;
        $db = lib_database::getInstance();
        $entity = lib_entity::getInstance();
        $sql = "select ss.name,c.id as country_id from states ss
                INNER JOIN countries cs on ss.country_id=cs.id
                INNER JOIN country c on cs.sortname = c.iso_code
             ";
        $rows = $db->fetchRows($sql);
        foreach ($rows as $row) {
            $entity->save("state", $row);
        }
    }

    function action_ajaxAddlayoutrow()
    {
        $smarty = lib_smarty::getSmartyInstance();
        $vjconfig = lib_config::getInstance()->getConfig();
        $globalModuleList = lib_datawrapper::getInstance()->get("module_list");
        $rmodule = $_POST['rmodule'];
        $viewtype = $_POST['viewtype'];
        $meta = json_decode($globalModuleList[$rmodule][$viewtype . 'def'], 1);
        $meta['type'] = $_POST['rowtype'];
        $smarty->assign("meta", $meta);
        $smarty->assign("viewtype", $viewtype);
        echo $smarty->fetch($vjconfig['fwbasepath'] . "resources/backend/modules/tableinfo/tpls/layoutrow.tpl");
    }

    function action_ajaxGetRelatedData()
    {
        $formodule = $_REQUEST['formodule'];
        $q = $_REQUEST['q'];
        $sql = "select id,name from " . $formodule . " where deleted=0 and name like '%" . $q . "%' ";
        $rows = lib_database::getInstance()->getAll($sql);

        $data = array();
        foreach ($rows as $row) {
            $arr = array();
            $arr['label'] = $row['name'];
            $arr['value'] = $row['id'];
            $data[] = $arr;
        }
        echo json_encode($data);
    }

    function action_updateFieldLabel()
    {
        $module = $_REQUEST['mod'];
        $field = $_REQUEST['field'];
        $lable = $_REQUEST['label'];

        if ($module && $field && $lable) {

            $tableinfo = lib_entity::getInstance()->getwhere("tableinfo", "name='" . $module . "'");

            if ($tableinfo) {

                $json = json_decode(base64_decode($tableinfo['description']), true);

                if (isset($json['fields'][$field])) {
                    $json['fields'][$field]['label'] = $lable;

                    $tableinfo['description'] = base64_encode(json_encode($json));
                    lib_entity::getInstance()->save("tableinfo", $tableinfo);
                }
            }
        }
    }

    function action_repairRelationships()
    {
        $db = lib_database::getInstance();

        $sql = "select * from tableinfo where deleted=0 ";
        $tbinfo = $db->getAll($sql, array(
            "id"
        ));
        $sql = "select * from relationships where deleted=0";
        $relationships = $db->getAll($sql, array(
            "id"
        ));

        foreach ($relationships as $relationship) {

            if (isset($tbinfo[$relationship['primarytable']]) && isset($tbinfo[$relationship['secondarytable']])) {

                $relationship['primary_table_text'] = $tbinfo[$relationship['primarytable']]['name'];

                $relationship['secondary_table_text'] = $tbinfo[$relationship['secondarytable']]['name'];

                $db->update("relationships", $relationship, "id");
            }
        }
    }
}