<?php
$dir = __DIR__ . '/';
require_once $dir . '../../libs/lib_current_user.php';
require_once $dir . '../../libs/lib_paginate.php';
require_once $dir . '../../libs/lib_modal.php';
require_once $dir . '../widget/WidgetServiceRegistrar.php';

class BackendResourceController extends ResourceController
{

    public $view = false;

    // private $data;
    public $params;

    public $entity;

    public $nonauth = array();

    public $listview = array(
        'pageinfo' => array()
    );

    public $editview = array(
        'tpl' => 'include/tpls/editview.tpl',
        'pageinfo' => array()
    );

    public $detailview = array(
        'tpl' => 'include/tpls/detailview.tpl',
        'pageinfo' => array()
    );

    public $basicview = array(
        'tpl' => 'include/tpls/detailview.tpl',
        'pageinfo' => array()
    );

    public $tpls = array();

    public $seourl = false;

    public $seoparams = array();

    public $ignoreRecords = array();

    public $additionalJoin = false;

    var $action;

    var $record;

    function __construct()
    {
        parent::__construct();

        $globalModuleList = lib_datawrapper::getInstance()->get("module_list");
        $this->entity = isset($_GET['module']) ? $_GET['module'] : false;
        $this->module = $this->entity;
        $this->action = isset($_GET['action']) ? $_GET['action'] : false;
        $this->record = isset($_REQUEST['record']) ? $_REQUEST['record'] : false;

        $current_user = lib_current_user::sessionCheck();

        if (! isset($this->nonauth[$this->action]) && ! $current_user) {
            die("Invalid Session");
        } else {
            if (isset($this->nonauth[$this->action]) && $current_user && isset($this->nonauth[$this->action]['redirect'])) {
                lib_util::redirect($this->nonauth[$this->action]['redirect']['module'], $this->nonauth[$this->action]['redirect']['action']);
            }

            if (! isset($this->nonauth[$this->action]) && $current_user) {
                if (! $current_user->isDeveloper) {
                    if (! (isset($globalModuleList[$this->entity]) && isset($current_user->module_access[$this->entity]))) {
                        die("Access denied !");
                    }
                }
            }
        }

        if ($this->entity) {

            $entity = lib_entity::getInstance();
            $entity->module = $this->entity;
            $tableinfo = $entity->getwhere("tableinfo", "name='" . $this->entity . "'");
            $entity->tableinfo = $tableinfo;

            if ($this->record) {
                $entity->record = $this->record;
                $data = $entity->get($this->entity, $this->record);
                $this->params['data'] = $data;
            }
        }
    }

    function utcToTimezone($datetime)
    {
        $vjconfig = lib_config::getInstance()->getConfig();
        $serverTimeZone = "UTC";
        if (isset($vjconfig['server_timezone'])) {
            $serverTimeZone = $vjconfig['server_timezone'];
        }
        $given = new DateTime($datetime, new DateTimeZone($serverTimeZone));
        $given->setTimezone(new DateTimeZone($vjconfig['timezone']));
        return $given->format("Y-m-d H:i:s");
    }

    function processListRow($row)
    {
        if (isset($row['date_entered'])) {
            $row['date_entered'] = $this->utcToTimezone($row['date_entered']);
        }
        if (isset($row['date_modified'])) {
            $row['date_modified'] = $this->utcToTimezone($row['date_modified']);
        }
        return $row;
    }

    function defaultPaginate($sql)
    {
        $db = lib_database::getInstance();
        $vjconfig = lib_config::getInstance()->getConfig();

        $paginate = lib_paginate::getInstance();
        $paginate->url = 'index.php?module=' . $this->entity . '&pageindex=';
        $paginate->index = 1;
        $paginate->noresult = 10;
        $paginate->endto = 10;
        $paginate->sql = $sql;
        $paginate->db = $db;

        $url = $vjconfig['urlbasepath'] . "backend/index.php?module=" . $this->entity . "&action=detailview&record=key_id";
        $url = lib_util::processUrl($url);
        $paginate->process['name'] = array(
            "tag" => "a",
            'value' => 'key_name',
            'attr' => array(
                "href" => $url
            )
        );
        $paginate->setProcessHook($this, "processListRow");
    }

    function setIgnoreRecords($ignoreRecords = array())
    {
        $this->ignoreRecords = $ignoreRecords;
    }

    function action_index()
    {
        $this->results();
        if (isset($this->listview['tpl'])) {
            $this->tpls[] = $this->listview['tpl'];
        }
        $this->view = "list";
    }

    function action_editview()
    {
        if (isset($_REQUEST['record'])) {
            // $mod = $_REQUEST['module'];

            // $id = $_REQUEST['id'];
            // $entity->get($mod,$id);
        }
        $this->tpls[] = $this->editview['tpl'];
        $this->view = "edit";
    }

    function action_detailview()
    {
        $this->tpls[] = $this->detailview['tpl'];
        $this->view = "detail";
    }

    function action_basicview()
    {
        $this->tpls[] = $this->basicview['tpl'];
        $this->view = "basic";
    }

    function getLanguageFieldData($suffix, $fields)
    {
        $data = array();
        foreach ($fields as $field) {
            if (isset($_POST[$field['name'] . '_' . $suffix])) {
                $data[$field['name']] = $_POST[$field['name'] . '_' . $suffix];
            }
        }
        return $data;
    }

    function action_save()
    {
        $entity = lib_entity::getInstance();
        $db = lib_database::getInstance();
        $globalEntityList = lib_datawrapper::getInstance()->get("entity_list");
        $globalModuleList = lib_datawrapper::getInstance()->get("module_list");
        $vjconfig = lib_config::getInstance()->getConfig();

        $data = $_POST;
        $module = $this->entity;
        $keyvalue = array();
        $table = $module;
        $keyvalue['isnew'] = 1;
        if (isset($data['id']) && ! empty($data['id'])) {
            $keyvalue = $entity->get($table, $data['id']);
            $keyvalue['isnew'] = 0;
        }

        foreach ($data as $key => $val) {
            $keyvalue[$key] = $val;
        }

        $tableinfo = $globalModuleList[$table];

        $editviewdef = json_decode($globalModuleList[$table]['editviewdef'], 1);
        if ($editviewdef) {
            foreach ($editviewdef as $row) {
                if (isset($row['fields'])) {
                    foreach ($row['fields'] as $col) {
                        if (isset($col['field'])) {
                            if (isset($col['field']['name'])) {
                                $fkey = $col['field']['name'];
                                $field = $tableinfo['tableinfo']['fields'][$fkey];
                                if ($field['type'] == "checkbox") {
                                    // echo "processing field is checkbox ".$field['name']."<br />";

                                    if (! isset($_REQUEST[$field['name']])) {
                                        $keyvalue[$field['name']] = 0;
                                    }
                                }
                            } else {
                                if (! is_array($col['field'])) {

                                    $fkey = $col['field'];
                                    $field = $tableinfo['tableinfo']['fields'][$fkey];
                                    if ($field['type'] == "checkbox") {
                                        // echo "processing field is checkbox ".$field['name']."<br />";

                                        if (! isset($_REQUEST[$field['name']])) {
                                            $keyvalue[$field['name']] = 0;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        if (isset($globalModuleList[$table]['metadata_info']['editview']['fields'])) {
            foreach ($globalModuleList[$table]['metadata_info']['editview']['fields'] as $fkey => $fval) {

                $field = $tableinfo['tableinfo']['fields'][$fkey];
                if ($field['type'] == "checkbox") {
                    if (! isset($_REQUEST[$field['name']])) {
                        $keyvalue[$field['name']] = 0;
                    }
                }
            }
        }

        foreach ($tableinfo['tableinfo']['fields'] as $field) {

            if ($field['type'] == "file" && isset($_FILES[$field['name']]) && $_FILES[$field['name']]['error'] == 0) {

                $mediaKeyValue = array();

                if (! $keyvalue['isnew'] || ! empty($keyvalue[$field['name']])) {
                    $mediaKeyValue = $entity->get("media_files", $keyvalue[$field['name']]);
                    if (isset($mediaKeyValue['file_path'])) {

                        unlink($mediaKeyValue['file_path']);
                    }
                }
                $fileId = lib_util::create_guid();
                $dir = $vjconfig['storage_basepath'] . "media_files/" . date("Y") . '/' . date("m") . '/' . date("d") . '/' . $_FILES[$field['name']]['type'];
                if (! is_dir($dir)) {
                    mkdir($dir, 0755, true);
                }
                $target = $dir . '/' . $fileId;
                $tmp = $_FILES[$field['name']]['tmp_name'];
                move_uploaded_file($tmp, $target);
                $mediaKeyValue['name'] = $_FILES[$field['name']]['name'];
                $mediaKeyValue['file_path'] = $target;
                $mediaKeyValue['file_type'] = $_FILES[$field['name']]['type'];

                $mediaId = $entity->save("media_files", $mediaKeyValue);

                $keyvalue[$field['name']] = $mediaId;
            }
        }
        $id = $entity->save($module, $keyvalue);

        $languages = $entity->getRelatedData("tableinfo_language_m_m", "tableinfo_id", $tableinfo['id']);

        $vardef = json_decode(base64_decode($tableinfo['description']), 1);

        foreach ($languages as $lang) {
            $suffix = $lang['name'];
            $langTable = $tableinfo['name'] . '_' . $suffix;
            if (isset($globalModuleList[$langTable])) {

                $idata = $this->getLanguageFieldData($suffix, $vardef['fields']);
                if ($idata) {
                    $data = array();
                    $langData = $entity->get($langTable, $id);
                    if (! $langData) {
                        $data['new_with_id'] = true;
                    }
                    $data['id'] = $id;
                    $data['name'] = $idata['name'];
                    unset($idata['name']);
                    $data['description'] = json_encode($idata);
                    $entity->save($langTable, $data);
                }
            }
        }

        $sql = "select * from relationships where secondarytable = '" . $tableinfo['id'] . "' and deleted=0 and rtype='1_M'";
        $rlist = $db->fetchRows($sql);

        foreach ($rlist as $relData) {

            if (isset($data[$relData['name']])) {
                if (isset($_REQUEST['rel']) && $_REQUEST['rel'] == $data[$relData['name']]) {
                    continue;
                }

                $parentId = $data[$relData['name']];
                $sql = "delete  from " . $relData['name'] . " where deleted=0 and " . $globalEntityList[$relData["secondarytable"]]['name'] . "_id='" . $id . "'";

                $db->query($sql);

                $entity->module = $relData['primary_table_text'];
                $entity->record = $parentId;
                $entity->addRelationship($relData['name'], $id);
            }
        }

        if (isset($_REQUEST['parent_module']) && isset($_REQUEST['parent_record']) && isset($_REQUEST['rel'])) {
            $relationship = $_REQUEST['rel'];
            $parentModule = $_REQUEST['parent_module'];
            $entity->setModule($parentModule);
            $entity->record = $_REQUEST['parent_record'];
            $entity->addRelationship($relationship, $id);
            lib_util::redirect($parentModule, "detailview", array(
                "record" => $entity->record
            ));
            exit();
        } else {

            $arr = array(
                "record" => $id
            );
            lib_util::redirect($module, "detailview", $arr);
        }
    }

    function results($sql = false, $paginate = true, $url = false)
    {
        $vardef = lib_util::getvardef($this->entity);
        $listviewdef = $vardef['metadata']['listview'];
        $this->listview['metadata'] = $listviewdef;
        $vardef['metadata']['searchview'] = isset($vardef['metadata']['searchview']) ? $vardef['metadata']['searchview'] : array(
            $listviewdef['name']
        );
        $this->listview['searchlayout'] = $vardef['metadata']['searchview'];
        $this->listview['fieldmetadata'] = $vardef['fields'];

        $table = $this->entity;
        $fields = array();

        $tableList = array();
        foreach ($listviewdef as $field => $def) {

            if (isset($def['rmodule'])) {
                $rtable = "";
                if (isset($tableList[$def['rmodule']])) {

                    $rtable = $def['rmodule'] . $tableList[$def['rmodule']];
                    $tableList[$def['rmodule']] = $tableList[$def['rmodule']] + 1;
                } else {
                    $rtable = $def['rmodule'];
                    $tableList[$def['rmodule']] = 1;
                }

                $fields[] = $rtable . "_r.name as " . $field . "_name";
            } else {
                $fields[] = $table . "." . $field;
            }
        }
        $paginate = lib_paginate::getInstance();

        $paginate->module = $this->entity;
        $paginate->href = $_SERVER['REQUEST_URI'];
        $paginate->extrafields = array();

        $url = "index.php?module=" . $this->entity . "&page=";
        if (! $sql) {

            $sql = "SELECT " . $table . ".id, " . implode(',', $fields) . " FROM " . $table . " ";
            if ($this->additionalJoin) {
                $sql .= $this->additionalJoin;
            }
            $tableList = array();

            foreach ($listviewdef as $field => $def) {
                if (isset($def['rmodule'])) {
                    $rtable = "";
                    if (isset($tableList[$def['rmodule']])) {

                        $rtable = $def['rmodule'] . $tableList[$def['rmodule']];
                        $tableList[$def['rmodule']] = $tableList[$def['rmodule']] + 1;
                    } else {
                        $rtable = $def['rmodule'];
                        $tableList[$def['rmodule']] = 1;
                    }

                    if ($def['type'] == "nondb") {
                        $sql .= " LEFT JOIN " . $def['name'] . "  ON " . $table . ".id =" . $def['name'] . "." . $table . "_id AND " . $def['name'] . ".deleted=0 ";
                        $sql .= " LEFT JOIN " . $def['rmodule'] . " " . $rtable . "_r  ON " . $def['name'] . "." . $def['rmodule'] . "_id =" . $rtable . "_r.id AND " . $rtable . "_r.deleted=0 ";
                    } else {
                        $sql .= " LEFT JOIN " . $def['rmodule'] . " " . $rtable . "_r  ON " . $table . "." . $field . "=" . $rtable . "_r.id AND " . $rtable . "_r.deleted=0";
                    }
                }
            }

            $sql .= " where " . $table . ".deleted=0 ";
            $searchview = $vardef['metadata']['searchview'];

            if (isset($_POST['listfilter'])) {
                $_SESSION['listfilter'][$_REQUEST['module']] = $_POST;
            }

            if (isset($_SESSION['listfilter'][$_REQUEST['module']])) {

                $this->params = $_SESSION['listfilter'][$_REQUEST['module']];
                foreach ($searchview as $key => $filter) {

                    if ($filter['type'] == 'varchar' && isset($_SESSION['listfilter'][$_REQUEST['module']][$key])) {
                        $trimkey = trim($_SESSION['listfilter'][$_REQUEST['module']][$key]);
                        if (! empty($trimkey)) {
                            $sql .= " AND " . $table . "." . $key . " like '" . addslashes($_SESSION['listfilter'][$_REQUEST['module']][$key]) . "' ";
                        }
                    }
                }
            }

            foreach ($this->ignoreRecords as $field => $records) {
                $sql .= " AND " . $field . " NOT IN ('" . implode("','", $records) . "') ";
            }
            $sql .= " order by " . $table . ".date_entered DESC";
        }
        $this->defaultPaginate($sql);
        if (isset($_REQUEST['pageindex'])) {
            $paginate->index = $_REQUEST['pageindex'];
        }
        $this->listview['pageinfo'] = $paginate->process();
        $this->listview['pageinfo']['resultperpage'] = $paginate->noresult;
    }

    function action_getAjaxSubPanelData()
    {
        $entity = lib_entity::getInstance();
        $smarty = lib_smarty::getSmartyInstance();
        $vjconfig = lib_config::getInstance()->getConfig();
        $ptable = $_REQUEST['ptable'];
        $relname = $_REQUEST['relname'];

        $index = $_REQUEST['page'];
        $entity->load_relationships();
        $table = $entity->relationships[$relname]['rtable'];

        $pageinfo = $entity->get_relationships($relname, $index);
        $rows = $pageinfo['data'];
        $rows = array_slice($rows, 0, $pageinfo['resultperpage'], true);

        $headers = array();
        $headers['name']['name'] = "name";
        $headers['name']['label'] = "Name";
        $headers['date_entered']['name'] = "date_entered";
        $headers['date_entered']['label'] = "Created";

        $moduleList = lib_datawrapper::getInstance()->get("module_list");
        $listviewdef = $moduleList[$table]['listviewdef'];

        $json = json_decode($listviewdef, 1);
        if ($json) {
            $headers = array();
            foreach ($json as $key => $val) {
                $headers[$key]['name'] = $key;
                $headers[$key]['label'] = $val;
            }
        }
        $smarty->assign("headers", $headers);
        $smarty->assign("rows", $rows);

        $extraPostFields = array();
        $extraPostFields['id']['data']['html'] = '<button type="button" onclick="removeRelationship(\'' . $entity->record . '\',\'' . $relname . '\',\'REPLACE_KEY\')" class="btn btn-danger">X</button>';
        $extraPostFields['id']['header']['html'] = '';
        $smarty->assign("extraPostFields", $extraPostFields);
        $table = $smarty->fetch($vjconfig['fwbasepath'] . "include/vjlib/libs/tpls/table.tpl");

        $pageinfo['url'] = "./index.php?module=" . $ptable . "&action=getAjaxSubPanelData";

        $pageinfo['container_id'] = $_REQUEST['container_id'];

        $pageinfo['record'] = $entity->record;
        $pagingHtml = lib_paginate::getInstance()->getPagingHtml($pageinfo, true);

        $table .= $pagingHtml;
        echo $table;

        exit();
    }

    function action_addSubpanelRelationship()
    {
        $entity = lib_entity::getInstance();
        $relname = $_REQUEST['relname'];
        $record = $_REQUEST['record'];

        foreach ($_REQUEST['recordList'] as $relId) {
            $entity->record = $record;
            $entity->addRelationship($relname, $relId);
        }
        $primaryModule = $_REQUEST['primaryModule'];
        header("location:index.php?module=" . $primaryModule . "&action=detailview&record=" . $record);
    }

    function action_removeAttachment()
    {
        require_once __DIR__ . '/../modules/media_files/MediaFilesService.php';
        $module = $_REQUEST['module'];
        $record = $_REQUEST['record'];
        $field = $_REQUEST['fieldname'];
        $id = $_REQUEST['id'];

        if ($record && $module) {
            $data = lib_entity::getInstance()->get($module, $record);
            $data[$field] = '';
            lib_entity::getInstance()->save($module, $data);
            MediaFilesService::getInstance()->removeMedia($id);
        }
    }

    protected function addNonauthMethod($method)
    {
        $this->nonauth[$method] = 1;
    }
}
?>