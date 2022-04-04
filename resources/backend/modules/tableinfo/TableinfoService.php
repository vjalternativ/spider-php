<?php

class TableinfoService
{

    private static $instance = null;

    private function __construct()
    {}

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new TableinfoService();
        }
        return self::$instance;
    }

    public function fixGridDef($defArray)
    {
        if (! is_array($defArray)) {
            $defArray = array();
        }
        foreach ($defArray as $rowindex => $row) {
            if (isset($row['fields'])) {

                $colSeq = 0;

                if (! isset($row['type'])) {
                    $defArray[$rowindex]['type'] = "row";
                }

                if (isset($row['fields']['field'])) {

                    $defArray[$rowindex]['fields'][$colSeq]['gridsize'] = 6;
                    $defArray[$rowindex]['fields'][$colSeq]['field'] = $rowindex;

                    unset($defArray[$rowindex]['fields']['field']);
                    unset($defArray[$rowindex]['fields']['gridsize']);
                }

                foreach ($row['fields'] as $colindex => $field) {

                    $colSeq ++;

                    if (is_array($field)) {
                        if (is_array($field['field'])) {
                            if (isset($field['field']['name'])) {
                                $defArray[$rowindex]['fields'][$colindex]['field'] = $field['field']['name'];
                            }
                        }
                    } else {

                        unset($defArray[$rowindex]['fields'][$colindex]);
                        unset($defArray[$rowindex]['fields']['gridsize']);
                        if ($colindex != "gridsize") {
                            $defArray[$rowindex]['fields'][$colSeq]['gridsize'] = 6;
                            $defArray[$rowindex]['fields'][$colSeq]['field'] = $field;
                        }
                    }
                }
            }
        }

        return $defArray;
    }

    function processGridWithFieldInfo($defArray, $fieldsData, $nameVsRelationship = array())
    {
        if (! is_array($defArray)) {
            $defArray = array();
        }
        foreach ($defArray as $rowindex => $row) {
            if (isset($row['fields'])) {
                foreach ($row['fields'] as $colindex => $field) {
                    if (isset($field['field'])) {
                        if (isset($fieldsData[$field['field']])) {
                            $defArray[$rowindex]['fields'][$colindex]['field'] = $fieldsData[$field['field']];
                        } else if ($nameVsRelationship && $nameVsRelationship[$field['field']]) {
                            $defArray[$rowindex]['fields'][$colindex]['field'] = $nameVsRelationship[$field['field']];
                        }
                    }
                }
            }
        }
        return $defArray;
    }
}
?>