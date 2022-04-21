<?php
$vjconfig = lib_config::getInstance()->getConfig();
require_once $vjconfig['fwbasepath'] . 'resources/backend/modules/user/authenticate/Authenticate.php';
require_once $vjconfig['fwbasepath'] . 'resources/backend/modules/adminarea/SchemaDataPatcher.php';

class adminareaBackendController extends BackendResourceController
{

    function action_home()
    {
        $this->view = 'home';
    }

    function action_repair()
    {
        $schemaDataPatcher = SchemaDataPatcher::getInstance();
        $vjconfig = lib_config::getInstance()->getConfig();
        $data = json_decode(file_get_contents($vjconfig['basepath'] . "schemajson/schema.json"), 1);
        $schemaDataPatcher->processSchemaAndDataPatch($data);
    }

    function action_generateCache()
    {
        $entity = lib_entity::getInstance();
        $entity->generateCache();
    }

    function action_updateschema()
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

    function changeFieldLayout($layout, $isSeq = false)
    {
        $layout = array_values($layout);
        $lt = array();
        foreach ($layout as $key => $field) {
            if ($isSeq) {
                $lt[$field['name']] = $field['name'];
            } else {
                if (isset($field['type'])) {
                    $lt[$key]['type'] = $field['type'];
                } else {
                    if (isset($field['fields'])) {
                        $lt[$key]['type'] = "row";
                    } else if (isset($field['label'])) {
                        $lt[$key]['type'] = "hr";
                    }
                }

                if (isset($field['fields'])) {
                    foreach ($field['fields'] as $field) {
                        $lt[$key]['fields'][] = array(
                            "field" => $field['field']['name'],
                            "gridsize" => $field['gridsize']
                        );
                    }
                }
                if (isset($field['label'])) {
                    $lt[$key]['label'] = $field['label'];
                }
            }
        }
        return $lt;
    }

    function action_showPatch()
    {
        $globalEntityList = lib_datawrapper::getInstance()->get("entity_list");
        $vjconfig = lib_config::getInstance()->getConfig();

        $cmd = 'mkdir -p ' . $vjconfig['basepath'] . 'include/install/datapatch';
        shell_exec($cmd);
        $cmd = 'mkdir -p ' . $vjconfig['basepath'] . 'include/install/schemapatch';
        shell_exec($cmd);

        $this->repairTables['user'] = 1;
        foreach ($globalEntityList as $key => $entity) {

            $name = $entity['name'];
            $desc = json_decode(base64_decode($entity['description']), 1);

            $jsonData = array();
            $jsonData['name'] = $name;
            $jsonData['type'] = $entity['tabletype'];
            $jsonData['label'] = $entity['label'];
            $jsonData['fields'] = $desc['fields'];

            // echo "<pre>";print_r($entity);die;
            $jsonData['listviewdef'] = isset($entity['listviewdef']) ? json_decode($entity['listviewdef']) : array();
            $jsonData['editviewdef'] = isset($entity['editviewdef']) ? json_decode($entity['editviewdef']) : array();
            $jsonData['detailviewdef'] = isset($entity['detailviewdef']) ? json_decode($entity['detailviewdef']) : array();
            $jsonData['searchviewdef'] = isset($entity['searchviewdef']) ? json_decode($entity['searchviewdef']) : array();

            if (isset($desc['metadata']['listview']) && ! $jsonData['listviewdef']) {
                $jsonData['listviewdef'] = $this->changeFieldLayout($desc['metadata']['listview'], true);
            }
            if (isset($desc['metadata']['editview']) && ! $jsonData['editviewdef']) {
                $jsonData['editviewdef'] = $this->changeFieldLayout($desc['metadata']['editview']);
            }
            if (isset($desc['metadata']['detailview']) && ! $jsonData['detailviewdef']) {
                $jsonData['detailviewdef'] = $this->changeFieldLayout($desc['metadata']['detailview']);
            }
            if (isset($desc['metadata']['searchview']) && ! $jsonData['searchviewdef']) {
                $jsonData['searchviewdef'] = $this->changeFieldLayout($desc['metadata']['searchview'], true);
            }

            unset($desc['metadata']);

            $globalEntityList[$key]['description'] = base64_encode(json_encode($desc));
            $globalEntityList[$key]['listviewdef'] = json_encode($jsonData['listviewdef']);
            $globalEntityList[$key]['editviewdef'] = json_encode($jsonData['editviewdef']);
            $globalEntityList[$key]['detailviewdef'] = json_encode($jsonData['detailviewdef']);
            $globalEntityList[$key]['searchviewdef'] = json_encode($jsonData['searchviewdef']);
            file_put_contents("include/install/schemapatch/" . $name . ".json", json_encode($jsonData, JSON_PRETTY_PRINT));
        }

        // echo "<pre>";print_r($globalEntityList);die;

        file_put_contents("include/install/datapatch/tableinfo.json", json_encode($globalEntityList, JSON_PRETTY_PRINT));

        $repairTables = $this->repairTables;
        unset($repairTables["tableinfo"]);
        $db = lib_database::getInstance();
        foreach ($repairTables as $key => $data) {
            $sql = "select * from " . $key . " where deleted=0";
            $data = $db->fetchRows($sql, array(
                "id"
            ));
            file_put_contents($vjconfig["basepath"] . "include/install/datapatch/" . $key . ".json", json_encode($data, JSON_PRETTY_PRINT));
        }
    }

    function action_repairFramework()
    {
        SchemaDataPatcher::getInstance()->repairFramework();
    }

    function action_cleanupmodules()
    {
        $db = lib_database::getInstance();
        $sql = "select name,group_concat(t.id) ids from tableinfo t group by t.name having count(*)>1";
        $rows = $db->fetchRows($sql);
        $data = array();
        foreach ($rows as $row) {
            $ids = explode(",", $row['ids']);
            $id = $ids[0];
            unset($ids[0]);
            $data[$id] = $ids;
        }

        foreach ($data as $id => $ids) {
            $sql = "update relationships set primarytable='" . $id . "' where primarytable in ('" . implode("'.'", $ids) . "') ";
            $db->query($sql);
            $sql = "update relationships set secondarytable='" . $id . "' where secondarytable in ('" . implode("'.'", $ids) . "') ";
            $db->query($sql);
            $sql = "delete from tableinfo where id in ('" . implode("'.'", $ids) . "')";
            $db->query($sql);
        }
        $sql = "select name,group_concat(id) as ids from relationships group by name having count(*) > 1";
        $rows = $db->fetchRows($sql);
        $data = array();
        foreach ($rows as $row) {
            $ids = explode(",", $row['ids']);
            $id = $ids[0];
            unset($ids[0]);
            $sql = "delete from relationships where id in ('" . implode("'.'", $ids) . "')";
            $db->query($sql);
        }

        // select r.*,t.id from relationships r left join tableinfo t on r.secondarytable=t.id where t.id is null;
        // select name,count(*) from relationships group by name having count(*) > 1;
        // select name,group_concat(t.id) ids from tableinfo t group by t.name having count(*)>1;
    }
}