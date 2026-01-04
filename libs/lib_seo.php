<?php

class lib_seo
{

    private static $instance = null;
    static function getInstance() {
        if(self::$instance==null) {
            self::$instance = new lib_seo();
        }
        return self::$instance;
    }

    private $params = array();
    function getParams() {
        return $this->params;
    }


    function get($index) {
        return isset($this->params[$index]) ? $this->params[$index] : false;
    }

    function __construct() {
        $config = lib_config::getInstance();
        $httpProtocol = "http";
        if (isset($_SERVER['HTTPS'])) {
            $httpProtocol = "https";
        }
        if (! isset($_SERVER['REQUEST_URI'])) {
            $_SERVER['REQUEST_URI'] = $config->get('baseurl');
        }

        if(isset($_SERVER['HTTP_HOST'])) {
            $http_host = $_SERVER['HTTP_HOST'];
            $strArray = explode(":", $http_host);
            if(isset($_SERVER['SERVER_PORT']) && count($strArray) ==1 && $_SERVER['SERVER_PORT'] != "80") {
                $http_host = $_SERVER['HTTP_HOST'] . ":" . $_SERVER['SERVER_PORT'];
            }
            $url = $httpProtocol . "://" . $http_host . $_SERVER["REQUEST_URI"];
            $canurlArray = explode("?", $url);
            $url = str_replace($config->get('baseurl'), "", $url);
            $strArray = explode("?", $url);
            $url = $strArray[0];
            $_REQUEST['canonicalurl'] = $canurlArray[0];
            $arr = explode("/", $url);
            foreach($arr as $val) {
                $val = trim($val);
                if($val) {
                    $this->params[] = $val;
                }
            }
        }
    }
}
?>
