<?php
$dir = __DIR__ . '/';
require_once $dir . '../../libs/lib_current_user.php';

class CliResourceController
{

    function __construct()
    {}

    function getarg($index)
    {
        return isset($_SERVER['argv'][$index]) ? $_SERVER['argv'][$index] : false;
    }

    function echo($message)
    {
        echo $message . PHP_EOL;
    }

    function readjson($file)
    {
        if (file_exists($file)) {
            return json_decode(file_get_contents($file), 1);
        } else {
            throw new Exception("invalid file path ");
        }
    }

    private function getCellVal($val, $colsize)
    {
        $blank = "";
        for ($i = strlen($val); $i <= $colsize; $i ++) {
            $blank .= " ";
        }
        $val .= $blank;
        return $val;
    }

    function getrowline($row, $colsize = 20)
    {
        $rowline = "";
        foreach ($row as $val) {
            $rowline .= $this->getCellVal($val, $colsize) . ' | ';
        }

        $rowline .= PHP_EOL;
        return $rowline;
    }

    function printcliTable($rows, $headers = array())
    {
        if ($headers) {
            echo $this->getrowline($headers);
        }
        foreach ($rows as $row) {
            if ($headers) {
                $vals = array();
                foreach ($headers as $key) {
                    $vals[] = isset($row[$key]) ? $row[$key] : "";
                }
                echo $this->getrowline($vals);
            } else {
                echo $this->getrowline($row);
            }
        }
    }

    function exec($cmd)
    {
        echo $cmd . PHP_EOL;
        $output = shell_exec($cmd);
        echo $output . PHP_EOL;
        return $output;
    }
}
?>