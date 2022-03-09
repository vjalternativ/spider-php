<?php

trait CLIService
{

    private $eol = "<br />";

    function __construct()
    {
        if (php_sapi_name() == "cli") {
            $this->eol = PHP_EOL;
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

    private function getrowline($row, $colsize = 20)
    {
        $rowline = "";
        foreach ($row as $val) {
            $rowline .= $this->getCellVal($val, $colsize) . ' | ';
        }

        $rowline .= PHP_EOL;
        return $rowline;
    }

    public function printcliTable($rows, $headers = array())
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

    public function exec($cmd)
    {
        echo $cmd . $this->eol;
        $output = exec($cmd);
        echo $output . $this->eol;
        return $output;
    }

    function getarg($index)
    {
        return isset($_SERVER['argv'][$index]) ? $_SERVER['argv'][$index] : false;
    }

    function echo($message)
    {
        echo $message . PHP_EOL;
    }
}
?>