<?php
class lib_postgres extends  lib_database {
    private $con;
    private function throwConnectionError() {
        throw new Exception("postgres connection failed");
    }
    public function connect($host, $user, $pwd, $name)
    {
        $string = "host= ".$host." ";
        $string .= "user= ".$user." ";
        if($pwd) {
            $string .= "password= ".$user." ";
        }
        $string .= "dbname= ".$name;
        $this->con = pg_connect($string) or $this->throwConnectionError();
    }


    public function query($sql)
    {
       return pg_query($this->con,$sql);
    }
    public function fetch($qry)
    {
            return pg_fetch_assoc($qry);
    }

    public function getrow($sql)
    {
        $qry = $this->query($sql);
        if($qry) {
            return $this->fetch($qry);
        }
        return false;
    }

    public function close()
    {
        pg_close($this->con);
    }
    public function getfields($table)
    {
        $meta =   pg_meta_data($this->con,$table);
        $meta = array_keys($meta);
        foreach($meta as  $key) {
            $meta[$key] = $key;
        }

        return $meta;
    }
    public function createTable($table, $cols)
    {}

    public function addColumn(DBField $field, $table)
    {}

    public function fieldExist($field, $table)
    {}

    public function tableExist($table)
    {}


}
?>