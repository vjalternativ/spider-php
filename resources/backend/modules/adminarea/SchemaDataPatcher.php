<?php

class SchemaDataPatcher
{

    private $repairTables = array();

    private function __construct()
    {
        $this->repairTables["tableinfo"] = 1;
        $this->repairTables["relationships"] = 1;
        $this->repairTables["tableinfo_relationships_1_m"] = 1;
        $this->repairTables["menu"] = 1;
        $this->repairTables["menu_tableinfo_1_m"] = 1;
        $this->repairTables["roles"] = 1;
        $this->repairTables["roles_item"] = 1;
        $this->repairTables["privilege"] = 1;
        $this->repairTables["roles_privilege_1_m"] = 1;
        $this->repairTables["language"] = 1;
        $this->repairTables["tableinfo_language_m_m"] = 1;
        $this->repairTables["submenu"] = 1;
        $this->repairTables["menu_submenu_1_m"] = 1;
        $this->repairTables["submenu_tableinfo_1_m"] = 1;
        $this->repairTables["form"] = 1;
        $this->repairTables["user"] = 1;
        $this->repairTables["media_files"] = 1;
    }

    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new SchemaDataPatcher();
        }
        return self::$instance;
    }

    function addRepairTable($table)
    {
        $this->repairTables[$table] = 1;
    }

    private function repairTableSchema($rows)
    {
        $entity = lib_entity::getInstance();
        $db = lib_database::getInstance();
        foreach ($rows as $row) {
            $desc = json_decode(base64_decode($row['description']), 1);
            $sql = "select 1 from " . $row['name'] . " limit 1";
            $qry = $db->query($sql, true);
            if ($qry) {

                $sql = "select * from tableinfo where name='" . $row['name'] . "'";

                $tbinfo = $db->getrow($sql);
                if ($tbinfo) {

                    $tbinfo['description'] = $row['description'];
                    $sql = "update tableinfo set description ='" . $row['description'] . "' where name='" . $row['name'] . "' ";
                    echo $sql . "<br />";
                    $db->query($sql);
                }

                if (isset($desc['fields'])) {
                    foreach ($desc['fields'] as $field) {
                        if ($field['type'] == "nondb") {
                            continue;
                        }
                        $dbField = $db->getfields($row['name']);
                        if (isset($dbField[$field['name']])) {
                            continue;
                        }
                        $fieldType = $field['type'];

                        $temp = array(
                            "name" => $field['name'],
                            'type' => $field['type']
                        );
                        if ($temp['type'] == "relate" || $temp['type'] == "file") {
                            $fieldType = "char";
                            $field['len'] = '36';
                            $temp['rmodule'] = $field['rmodule'];
                        } else if ($temp['type'] == 'dependent_relate') {
                            $fieldType = "char";
                            $field['len'] = '36';

                            $temp['rmodule'] = $field['rmodule'];
                            $temp['dependent_relate_field'] = $field['dependent_relate_field'];
                            $temp['dependent_relate_field'] = $field['dependent_relate_field'];
                            $temp['relate_relationship'] = $field['relate_relationship'];
                        } else if ($temp['type'] == "checkbox") {
                            $fieldType = "int";
                        } else if ($temp['type'] == "enum") {
                            $fieldType = "varchar";
                            $field['len'] = "200";
                            $temp['options'] = $field['options'];
                        } else if ($temp['type'] == "multienum") {
                            $fieldType = "text";
                        }

                        $sql = "ALTER TABLE " . $row['name'] . " ADD COLUMN " . $field['name'] . " " . $fieldType . " ";

                        if ($field['len'] != "") {
                            $temp['len'] = $field['len'];
                            $sql .= " (" . $field['len'] . ") ";
                        }

                        if ($field['notnull'] == 'true') {
                            $sql .= " NOT NULL ";
                            $temp['notnull'] = 1;
                        }

                        if ($field['default'] != '') {

                            $default = " default '" . $field['default'] . "' ";
                            $sql .= $default;
                            $temp['default'] = $default;
                        }

                        if (! empty($field['field_index'])) {
                            $temp['field_index'] = $field['field_index'];
                        }

                        echo $sql . "<br />";
                        $db->query($sql);
                    }
                }
            } else {

                // $entity = new Entity;

                $desc['type'] = $row['tabletype'];
                $entity->createEntity($row['name'], $desc, true);
                echo ("repair new table " . $row['name'] . "<br />");
            }
        }
    }

    private function updateDataPatch($data)
    {
        $db = lib_database::getInstance();
        $entity = lib_entity::getInstance();
        foreach ($data as $table => $rows) {

            $sql = "select * from " . $table . " where deleted=0";
            $tableRows = $db->fetchRows($sql, array(
                "id"
            ));
            foreach ($rows as $id => $row) {
                if (isset($tableRows[$id])) {
                    echo "updating table " . $table . " for ID " . $id . "<br />";
                } else {
                    $row['new_with_id'] = true;
                    echo "inserting table " . $table . " for ID " . $id . "<br />";
                }
                $row['hook_skip'] = true;
                $entity->save($table, $row);
            }
        }
    }

    private function repairRelationship()
    {
        $sql = "select * from relationships where deleted=0";
        $rows = lib_database::getInstance()->getrows($sql);
        foreach ($rows as $row) {
            if (! $row['primary_table_text']) {
                $id = $row['primarytable'];

                $tb = lib_database::getInstance()->get("tableinfo", "id", $id);

                $row['primary_table_text'] = $tb['name'];

                lib_database::getInstance()->update("relationships", $row, "id");
            }
        }
    }

    public function processSchemaAndDataPatch($data)
    {
        $entity = lib_entity::getInstance();
        $rows = $data['tableinfo'];
        $this->repairTableSchema($rows);
        $this->updateDataPatch($data);
        $this->repairRelationship();
        $entity->generateCache();
    }

    function repairFramework()
    {
        $vjconfig = lib_config::getInstance()->getConfig();
        $data = array();
        foreach ($this->repairTables as $tablename => $row) {
            $row = json_decode(file_get_contents($vjconfig['fwbasepath'] . "include/install/datapatch/" . $tablename . ".json"), 1);
            $data[$tablename] = $row;
        }
        $this->processSchemaAndDataPatch($data);
    }

    public function updateSchema()
    {
        $db = lib_database::getInstance();
        $vjconfig = lib_config::getInstance()->getConfig();
        $data = array();
        foreach ($this->repairTables as $table => $val) {
            $sql = "select * from " . $table . " where deleted=0";
            $data[$table] = $db->fetchRows($sql, array(
                "id"
            ));
        }
        file_put_contents($vjconfig['basepath'] . "schemajson/schema.json", json_encode($data, JSON_PRETTY_PRINT));
    }

    public function updateFrameworkPatch()
    {
        $basepath = lib_config::getInstance()->get("basepath");
        $fwbasepath = lib_config::getInstance()->get("fwbasepath");

        $datapatchpath = $basepath . 'include/install/datapatch/';
        $fwdatapatchpath = $fwbasepath . 'include/install/datapatch/';

        $schemapatchpath = $basepath . 'include/install/schemapatch/';
        $fwschemapatchpath = $fwbasepath . 'include/install/schemapatch/';

        $tableinfo = json_decode(file_get_contents($datapatchpath . 'tableinfo.json'), true);
        $fwtableinfo = json_decode(file_get_contents($fwdatapatchpath . 'tableinfo.json'), true);

        $nameVsId = array();
        foreach ($tableinfo as $id => $info) {
            $nameVsId[$info['name']] = $id;
        }

        foreach ($this->repairTables as $table => $val) {
            unlink($fwschemapatchpath . $table . '.json');
            $cmd = 'cp ' . $schemapatchpath . $table . '.json ' . $fwschemapatchpath . $table . '.json';
            shell_exec($cmd);

            $id = $nameVsId[$table];
            if (isset($fwtableinfo[$id])) {
                $fwtableinfo[$id] = $tableinfo[$id];
            }
        }

        file_put_contents($fwdatapatchpath . 'tableinfo.json', json_encode($fwtableinfo, JSON_PRETTY_PRINT));
    }
}
?>