<?php
class tableinfoLogicHook {


    function beforeSave(&$keyvalue) {
        $keyvalue = $this->repairTableinfoEntity($keyvalue);
    }

    function afterSave(&$keyvalue) {
        $entity = lib_entity::getInstance();
        if($keyvalue['hook_isnew'] && $keyvalue['tabletype']=="user") {
            $id = $keyvalue['id'];
            $data = array();
            $data['name'] = $keyvalue['name'];
            $data['id'] = $id;
            $data['new_with_id'] = true;
            $entity->save("roles",$data);
        }

    }

    function repairTableinfoEntity($keyvalue) {


        $desc = json_decode(base64_decode($keyvalue['description']),1);
        $lib_entity = lib_entity::getInstance();
        $table = $keyvalue['name'];
        $fields = $lib_entity->getDefaultFields($keyvalue['tabletype']);

        $globalModuleList = lib_datawrapper::getInstance()->get("module_list");
        if(isset($globalModuleList[$table])) {
            $dbFields = $desc['fields'];
            foreach($fields as $field) {
                if(isset($dbFields[$field['name']])) {
                    continue;
                }
                $dbFields[$field['name']] =$field;
                $sql = "ALTER TABLE ".$table." ADD COLUMN ".$lib_entity->convertFieldArrayToString($field);
                lib_database::getInstance()->query($sql,true);
            }
            $meta = json_decode(base64_decode($keyvalue['description']),1);
            $metadata = isset($meta['metadata']) ? $meta['metadata'] : array();

            $keyvalue['editviewdef'] = (empty($keyvalue['editviewdef']) && isset($metadata['editview'])) ? $metadata['editview'] : $keyvalue['editviewdef'];
            $keyvalue['detailviewdef'] = (empty($keyvalue['detailviewdef']) && isset($metadata['detailview'])) ? $metadata['detailview'] : $keyvalue['detailviewdef'];
            $keyvalue['listviewdef'] = (empty($keyvalue['listviewdef']) && isset($metadata['editview'])) ? $metadata['editview'] : $keyvalue['listviewdef'];
            $keyvalue['searchviewdef'] = (empty($keyvalue['searchviewdef']) && isset($metadata['searchview'])) ? $metadata['editview'] : $keyvalue['listviewdef'];

            $metadata['fields'] = $dbFields;
            $keyvalue = $this->fixDef($keyvalue);
            $keyvalue['description'] = base64_encode(json_encode(array("fields"=>$metadata['fields'])));

        }

        return  $keyvalue;
    }

    function fixGridDef($defArray) {
        if(!is_array($defArray)){
            $defArray =array();
        }
        foreach($defArray as $rowindex=>$row) {
            if(isset($row['fields'])) {
                foreach($row['fields'] as $colindex => $field) {
                    if(is_array($field['field'])) {
                        if(isset($field['field']['name'])) {
                            $defArray[$rowindex]['fields'][$colindex]['field'] = $field['field']['name'];
                        }
                    }
                }
            }
        }

        return $defArray;
    }

    function fixListDef($defArray) {
        if(!is_array($defArray)){
            $defArray =array();
        }
        foreach($defArray as $key => $field) {
            if(is_array($field)) {
                $defArray[$key] = $key;
            }
        }

        return $defArray;
    }

    function fixDef($keyvalue) {

        $listview = is_array($keyvalue['listviewdef']) ? $keyvalue['listviewdef'] : json_decode($keyvalue['listviewdef'],1);
        $editview = is_array($keyvalue['editviewdef']) ? $keyvalue['editviewdef'] : json_decode($keyvalue['editviewdef'],1);
        $detailview = is_array($keyvalue['detailviewdef']) ? $keyvalue['detailviewdef'] : json_decode($keyvalue['detailviewdef'],1);
        $searchview = is_array($keyvalue['searchviewdef']) ? $keyvalue['searchviewdef'] : json_decode($keyvalue['searchviewdef'],1);
        $keyvalue['listviewdef'] = json_encode($this->fixListDef($listview));
        $keyvalue['editviewdef'] = json_encode($this->fixGridDef($editview));
        $keyvalue['detailviewdef'] = json_encode($this->fixGridDef($detailview));
        $keyvalue['searchviewdef'] = json_encode($this->fixListDef($searchview));

        return  $keyvalue;



    }
}
?>