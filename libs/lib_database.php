<?php
require_once lib_config::getInstance()->get("fwbasepath") . 'beans/DBField.php';

abstract class lib_database
{

    private static $instance = null;

    public $processHook = array(
        "instance" => "",
        "method" => "",
        "enumList" => array()
    );

    public $dimindexer = array();

    private $processSeq = false;

    private $debug = false;

    function setProcessSequence($b)
    {
        $this->processSeq = $b;
    }

    function setDebugMode($b)
    {
        $this->debug = $b;
    }

    function setProcessHook($instance, $method)
    {
        $this->processHook['instance'] = $instance;
        $this->processHook['method'] = $method;
    }

    function print_bt()
    {
        echo "<br />";
        echo "<pre>";
        debug_print_backtrace();
        return "";
    }

    function getrows($sql, $id = false, $value = false, $extrafields = false, $process = false, $debug = false)
    {
        $rows = array();
        $qry = $this->query($sql);
        while ($row = $this->fetch($qry)) {

            if (isset($this->processHook['method']) && $this->processHook['method']) {
                if (isset($this->processHook['instance']) && $this->processHook['instance']) {
                    $row = call_user_func(array(
                        $this->processHook['instance'],
                        $this->processHook['method']
                    ), $row);
                } else {
                    $row = call_user_func($this->processHook['method'], $row);
                }
            }

            if ($id) {
                $listIndex = $row[$id];
            }
            if ($extrafields) {
                foreach ($extrafields as $key => $field) {
                    if (isset($field['field'])) {
                        $row[$key] = $row[$field['field']];
                    } else {
                        $row[$key] = $field['value'];
                    }
                    if (isset($field['condition'])) {
                        $list = $field['condition']['list'];

                        if (isset($list[$row[$field['condition']['field']]])) {
                            $row[$key] = $field['condition']['value'];
                        } else {
                            $row[$key] = $field['value'];
                        }
                    }
                }
            }

            if ($process) {
                $processList = $row;
                foreach ($process as $key => $proc) {
                    $rowval = $row[$key];
                    $isdualtag = true;
                    if (isset($proc['isdualtag'])) {
                        $isdualtag = $proc['isdualtag'];
                    }
                    if ($isdualtag == false) {
                        $proc['attr']['value'] = $rowval;
                    }
                    if (isset($proc['attr']['data-relate-name'])) {
                        $proc['attr']['data-relate-name'] = $row['name'];
                    }
                    if (isset($proc['value'])) {
                        $strs = explode('_', $proc['value']);
                        $rowval = $proc['value'];
                        if ($strs[0] == 'key') {
                            $rowval = $row[$strs[1]];
                        }
                    }

                    foreach ($proc['attr'] as $pkey => $tempattr) {
                        foreach ($row as $col => $val) {
                            $tempattr = str_replace("key_" . $col, $val, $tempattr);
                        }
                        $proc['attr'][$pkey] = $tempattr;
                    }

                    $processList[$key] = getelement($proc['tag'], $rowval, $proc['attr'], $isdualtag);
                }
                $row = $processList;
            }

            if ($id && $value) {
                $rows[$listIndex] = $row[$value];
            } else if ($id) {
                $rows[$listIndex] = $row;
            } else {
                $rows[] = $row;
            }
        }

        $this->resetHook();
        return $rows;
    }

    private $isFirstRow = false;

    function setIsFirstRow($b)
    {
        $this->isFirstRow = $b;
    }

    function fetchRows($sql = "", $dim = false, $val = false, $die = true)
    {
        $rows = array();
        $temp = &$rows;
        $qry = $this->query($sql, true);
        if (! $qry) {
            if ($die) {
                echo "<pre>";
                print_r(debug_print_backtrace());

                die("wrong query " . $sql);
            } else {
                return false;
            }
        }

        $checkFirst = true;
        $this->dimindexer = array();

        while ($row = $this->fetch($qry)) {
            if ($this->isFirstRow) {
                if ($checkFirst) {
                    $row['isfirstrow'] = true;
                    $checkFirst = false;
                } else {
                    $row['isfirstrow'] = false;
                }
            }

            if (isset($this->processHook['enumList']) && $this->processHook['enumList']) {
                foreach ($this->processHook['enumList'] as $col => $enumkey) {
                    $row[$col] = $this->getEnumValue($enumkey, $row[$col]);
                }
            }
            if (isset($this->processHook['method']) && $this->processHook['method']) {
                if (isset($this->processHook['instance']) && $this->processHook['instance']) {
                    $row = call_user_func(array(
                        $this->processHook['instance'],
                        $this->processHook['method']
                    ), $row);
                } else {
                    $row = call_user_func($this->processHook['method'], $row);
                }
            }
            if ($dim) {

                if ($this->processSeq) {
                    $row = $this->processDimIndexer($row, $dim);
                }
                foreach ($dim as $dimkey => $index) {
                    $cols = false;

                    if (is_array($index)) {
                        if (isset($index['cols'])) {
                            $cols = $index['cols'];
                            $index = $index['key'];
                        } else {
                            $cols = $index;
                            $index = $dimkey;
                        }
                    }

                    if ($cols) {
                        if (! isset($temp[$row[$index]])) {
                            foreach ($cols as $col) {
                                if (isset($row[$col])) {
                                    $temp[$row[$index]][$col] = $row[$col];
                                }
                            }
                            $temp[$row[$index]]['items'] = false;
                        }
                    } else {
                        if (! isset($temp[$row[$index]])) {
                            $temp[$row[$index]] = false;
                        }
                    }

                    if ($cols) {
                        $temp = &$temp[$row[$index]]['items'];
                    } else {
                        $temp = &$temp[$row[$index]];
                    }
                }

                if ($val) {
                    $temp = $row[$val];
                } else {

                    $temp = $row;
                }
            } else {
                if ($val) {
                    $rows[$row[$val]] = $row[$val];
                } else {
                    $rows[] = $row;
                }
            }
            $temp = &$rows;
        }

        $this->resetHook();
        $this->processSeq = false;
        return $rows;
    }

    function resetHook()
    {
        $this->processHook = array();
        $this->isFirstRow = false;
    }

    function getTabelFieldSetSql($table, $row, $extraFields = array())
    {
        $fields = $this->getfields($table);

        $fieldSet = array();
        foreach ($row as $key => $val) {
            $val = addslashes($val);
            if (isset($fields[$key])) {
                $fieldSet[] = $key . " = '" . $val . "'";
            }
        }

        foreach ($extraFields as $field) {
            $fieldSet[] = $field;
        }

        return " " . $table . " SET " . implode(",", $fieldSet);
    }

    function insert($table, $row)
    {
        $sql = "INSERT INTO " . $this->getTabelFieldColValueSql($table, $row, array(
            'date_added' => 'now()'
        ));

        return $this->query($sql, true);
    }

    function update($table, $row, $idcolumn, $where = false)
    {
        if (isset($row[$idcolumn])) {
            $sql = "UPDATE " . $this->getTabelFieldSetSql($table, $row, array(
                'date_updated = now()'
            ));
            $sql .= " WHERE " . $idcolumn . "= '" . $row[$idcolumn] . "' ";
            if ($where) {
                $sql .= " AND " . $where;
            }
            return $this->query($sql, true);
        } else {
            return false;
        }
    }

    function get($table, $col, $value)
    {
        $sql = "select * from " . $table . " where " . $col . "='" . $value . "' ";
        return $this->getrow($sql);
    }

    function processDimIndexer($row, $dim)
    {
        $seqdim = array();
        foreach ($dim as $key => $val) {
            if (is_array($val)) {
                $seqdim[] = $key;
            } else {
                $seqdim[] = $val;
            }
        }
        $skey = "seq";
        $sval = false;
        $vval = "val_";
        $ikey = "rseq";
        foreach ($seqdim as $index) {
            $vval .= "_" . $row[$index];
            $skey .= "_" . $index;
            $ikey .= "_" . $index;
            if (isset($this->dimindexer['last_seq_indexes'][$skey])) {
                if (! isset($this->dimindexer['vals'][$skey][$vval])) {
                    $this->dimindexer['last_seq_indexes'][$skey] ++;
                    $this->dimindexer['vals'][$skey][$vval] = $this->dimindexer['last_seq_indexes'][$skey];
                }
            } else {
                $this->dimindexer['last_seq_indexes'][$skey] = 0;
                $this->dimindexer['vals'][$skey][$vval] = 0;
            }
            $row[$skey] = $this->dimindexer['last_seq_indexes'][$skey];

            if ($sval) {
                if (isset($this->dimindexer['last_iseq_indexes'][$ikey . "_" . $sval])) {
                    if (! isset($this->dimindexer['vals'][$ikey . "_" . $sval][$vval])) {
                        $this->dimindexer['last_iseq_indexes'][$ikey . "_" . $sval] ++;
                        $this->dimindexer['vals'][$ikey . "_" . $sval][$vval] = $this->dimindexer['last_iseq_indexes'][$ikey . "_" . $sval];
                    }
                } else {
                    $this->dimindexer['last_iseq_indexes'][$ikey . "_" . $sval] = 0;
                    $this->dimindexer['vals'][$ikey . "_" . $sval][$vval] = $this->dimindexer['last_iseq_indexes'][$ikey . "_" . $sval];
                }
                $row[$ikey] = $this->dimindexer['last_iseq_indexes'][$ikey . "_" . $sval];
                $sval .= "_" . $row[$index];
            } else {
                $sval = "val_" . $row[$index];
            }
        }
        return $row;
    }

    private static function getIDBProfile(lib_database $ob)
    {
        return $ob;
    }

    abstract function getfields($table);

    abstract function connect($host, $user, $pwd, $name);

    abstract function query($sql);

    abstract function fetch($qry);

    abstract function getrow($sql);

    abstract function close();

    private static function getDBProfileInstance()
    {
        $dbProfiles = array();
        $dbProfiles['postgres'] = true;
        $dbProfiles['mysqli'] = true;
        $dbProfile = lib_config::getInstance()->get("dbprofile");
        $dbProfile = isset($dbProfiles[$dbProfile]) ? $dbProfile : "mysqli";
        $dir = __DIR__ . '/';
        require_once $dir . 'lib_' . $dbProfile . '.php';
        $class = 'lib_' . $dbProfile;
        return new $class();
    }

    static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = self::getDBProfileInstance();
        }
        return self::getIDBProfile(self::$instance);
    }

    function getTabelFieldColValueSql($table, $row, $extraFields = array())
    {
        $fields = $this->getfields($table);

        $cols = array();
        $vals = array();
        foreach ($row as $key => $val) {
            $val = addslashes($val);
            if (isset($fields[$key])) {
                $cols[] = $key;
                $vals[] = "'" . $val . "'";
            }
        }

        foreach ($extraFields as $key => $val) {
            $cols[] = $key;
            $vals[] = $val;
        }

        return " " . $table . " (" . implode(",", $cols) . ") values (" . implode(",", $vals) . ") ";
    }

    abstract function fieldExist($field, $table);

    abstract function tableExist($table);

    abstract function createTable($table, $cols);

    abstract function addColumn(DBField $field, $table);
}
?>