<?php

class lib_mysqli extends lib_database
{

    public $con;

    public $processHook = array(
        "instance" => "",
        "method" => "",
        "enumList" => array()
    );

    public $dimindexer = array();

    private $debug = false;

    private static $instance = null;

    private $db_name;

    function __construct()
    {}

    static function getInstance()
    {
        parent::getInstance();
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

    function connect($host = "locahost", $user = "root", $password = "", $database = "framework")
    {
        $this->db_name = $database;
        $this->con = mysqli_connect($host, $user, $password, $database) or die("database connection failed");

        if (mysqli_connect_errno()) {
            die(mysqli_connect_error());
        }
        mysqli_set_charset($this->con, "utf8mb4");
        $this->query("SET SESSION sql_mode=''");
        $this->query("SET SESSION wait_timeout = 600");
        $this->query("set SESSION innodb_lock_wait_timeout=200");
        $this->query("set SESSION net_read_timeout=600");
        $this->query("set SESSION net_write_timeout=600");
        // $this->query('SET GLOBAL connect_timeout=28800');
        $this->query('SET SESSION wait_timeout=28800');
        $this->query('SET SESSION interactive_timeout=28800');
        // $this->query("set SESSION net_buffer_length=1000000");
        // $this->query("set SESSION max_allowed_packet=1000000000");
    }

    function getfields($table = false)
    {
        if (! $table) {
            die("table name should be set for get fields");
        }
        $fields = array();
        $sql = "SHOW COLUMNS FROM " . $table;
        $fields = $this->fetchRows($sql, array(
            "Field"
        ), "Field");
        return $fields;
    }

    function print_bt()
    {
        echo "<br />";
        echo "<pre>";
        debug_print_backtrace();
        return "";
    }

    function query($sql, $return = false)
    {
        if ($return) {
            $qry = mysqli_query($this->con, $sql);
            return $qry;
        }
        $qry = mysqli_query($this->con, $sql) or die("Query Failed :" . $sql . "<br />" . mysqli_error($this->con) . $this->print_bt());
        return $qry;
    }

    function fetch($qry)
    {
        return mysqli_fetch_assoc($qry);
    }

    function getrow($sql)
    {
        // echo $sql."<br />";
        $qry = mysqli_query($this->con, $sql);
        if ($qry) {
            return mysqli_fetch_assoc($qry);
        } else {
            echo "wrong query for get row " . $sql;
            echo "<pre>";
            print_r(debug_print_backtrace());
            die();
        }
    }

    // deprecated
    function getrows($sql, $id = false, $value = false, $extrafields = false, $process = false, $debug = false)
    {
        // replace query with inbuilt mysqli functions
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

                    $processList[$key] = lib_util::getelement($proc['tag'], $rowval, $proc['attr'], $isdualtag);
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

    function resetHook()
    {
        $this->processHook = array();
        $this->isFirstRow = true;
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

    function insert($table, $row, $suffixKeyValue = array(), $return = false)
    {
        $sql = "INSERT INTO " . $this->getTabelFieldSetSql($table, $row, $suffixKeyValue);

        return $this->query($sql, $return);
    }

    function get($table, $col, $value)
    {
        $sql = "select * from " . $table . " where " . $col . "='" . $value . "' ";
        return $this->getrow($sql);
    }

    function insertRows($table, $rows, $caselower = false, $return = true)
    {
        if ($rows) {
            $sql = "INSERT INTO " . $table;
            $fields = $this->getfields($table);
            $firstRow = reset($rows);

            $cols = array();

            if ($caselower) {
                foreach ($firstRow as $col => $value) {
                    $cols[] = strtolower($col);
                    $firstRow[$col] = $value;
                }
            } else {
                $cols = array_keys($firstRow);
            }

            $targetFields = array_intersect($fields, $cols);
            $valueArray = array();
            foreach ($rows as $row) {
                $values = array();

                $newrow = array();
                foreach ($row as $col => $value) {
                    if ($caselower) {
                        $newrow[strtolower($col)] = $value;
                    } else {
                        $newrow[$col] = $value;
                    }
                }

                foreach ($targetFields as $field) {

                    $values[] = "'" . addslashes($newrow[$field]) . "'";
                }
                $valueArray[] = "(" . implode(",", $values) . ")";
            }
            $sql .= "(" . implode(",", $targetFields) . ") values " . implode(",", $valueArray);
            return $this->query($sql, $return);
        }
    }

    public function close()
    {
        mysqli_close($this->con);
    }

    public function fieldExist($field, $table)
    {
        $sql = "SHOW COLUMNS FROM " . $table . " where field = '" . $field . "'";
        return $this->getrow($sql) ? true : false;
    }

    public function tableExist($table)
    {
        $sql = "show tables where tables_in_" . $this->db_name . " ='" . $table . "'";
        return $this->getrow($sql) ? true : false;
    }

    public function addColumn(DBField $field, $table)
    {
        $sql = "ALTER TABLE " . $table . " ADD COLUMN `" . $field->getName() . "` " . $field->getDataType() . " ";
        if ($field->getLength()) {
            $sql .= " ( " . $field->getLength() . " ) ";
        }
        if ($field->getIndex()) {
            $sql .= "  " . $field->getIndex() . " ";
        }
        $this->query($sql);
    }

    public function createTable($table, $cols)
    {
        if (! $cols) {
            throw new \Exception("can not create table without cols");
        }

        $sql = "CREATE TABLE " . $table . " ( ";

        $colarray = array();
        foreach ($cols as $col) {
            $col = DBField::as($col);
            $colsql = $col->getName() . "  " . $col->getDataType();
            if ($col->getLength()) {
                $colsql .= " ( " . $col->getLength() . " ) ";
            }
            if ($col->getIndex()) {
                $colsql .= " ( " . $col->getIndex() . " ) ";
            }
            $colarray[] = $colsql;
        }

        $sql .= implode(",", $colarray);

        $sql .= " )";

        $this->query($sql);
    }

    public function getConnectionObject()
    {
        return $this->con;
    }
}