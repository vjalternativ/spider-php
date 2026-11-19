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
        // Match lib_config.php's baseurl scheme detection: isset() alone is true
        // even when HTTPS=off, which would build an https:// prefix that cannot
        // match an http:// baseurl.  A correct scheme is what makes 443 a default port.
        if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
            $httpProtocol = "https";
        }
        if (! isset($_SERVER['REQUEST_URI'])) {
            $_SERVER['REQUEST_URI'] = $config->get('baseurl');
        }

        if(isset($_SERVER['HTTP_HOST'])) {
            $http_host = $_SERVER['HTTP_HOST'];
            $strArray = explode(":", $http_host);
            // Append a port only for non-default ports. 80/443 are the HTTP/HTTPS
            // defaults and browsers omit them from HTTP_HOST; appending them builds
            // e.g. https://example.com:443/... which no longer matches
            // $config['baseurl'] ("https://example.com/") in the str_replace below.
            if(isset($_SERVER['SERVER_PORT']) && count($strArray) ==1
                && !in_array($_SERVER['SERVER_PORT'], array("80", "443"))) {
                $http_host = $_SERVER['HTTP_HOST'] . ":" . $_SERVER['SERVER_PORT'];
            }
            $url = $httpProtocol . "://" . $http_host . $_SERVER["REQUEST_URI"];
            $canurlArray = explode("?", $url);
            $baseurl = $config->get('baseurl');
            $url = str_replace($baseurl, "", $url);
            if (strpos($url, "://") !== false) {
                // Prefix still did not match baseurl (proxy/port/host mismatch).
                // Fall back to the request path so SEO params stay correct.
                $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
                $basePath = rtrim((string) parse_url($baseurl, PHP_URL_PATH), "/");
                if ($basePath !== "" && strpos($url, $basePath . "/") === 0) {
                    $url = substr($url, strlen($basePath));
                }
            }
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
