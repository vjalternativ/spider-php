<?php

class lib_util
{

   static function redirect($module, $action = false, $params = array())
    {

        $basepath = lib_config::getInstance()->get("baseurl").$_GET['resource'].'/';
        $string = $basepath."index.php?module=" . $module;
        if ($action) {
            $string .= "&action=" . $action;
        }
        foreach ($params as $key => $val) {
            $string .= "&" . $key . "=" . $val;
        }
        header('location:' . $string);
        exit();
    }

   static function sessioncheck($var)
    {
        if (! isset($_SESSION[$var])) {
            return false;
        }

        // return $_SESSION[$var];
        if ($var == 'current_user') {
            $array = json_decode($_SESSION[$var], 1);

            global $current_user;
            $obj = new lib_entity();
            foreach ($array as $key => $val) {
                $obj->$key = $val;
            }
            $current_user = $obj;
            return $obj;
            echo "<pre>";
            print_r($obj);
        }
        return $_SESSION[$var];
    }

    static function create_guid()
    {
        $microTime = microtime();
        list ($a_dec, $a_sec) = explode(" ", $microTime);

        $dec_hex = dechex($a_dec * 1000000);
        $sec_hex = dechex($a_sec);

        self::ensure_length($dec_hex, 5);
        self::ensure_length($sec_hex, 6);

        $guid = "";
        $guid .= $dec_hex;
        $guid .= self::create_guid_section(3);
        $guid .= '-';
        $guid .= self::create_guid_section(4);
        $guid .= '-';
        $guid .= self::create_guid_section(4);
        $guid .= '-';
        $guid .= self::create_guid_section(4);
        $guid .= '-';
        $guid .= $sec_hex;
        $guid .= self::create_guid_section(6);

        return $guid;
    }

    static function create_guid_section($characters)
    {
        $return = "";
        for ($i = 0; $i < $characters; $i ++) {
            $return .= dechex(mt_rand(0, 15));
        }
        return $return;
    }

    static function ensure_length(&$string, $length)
    {
        $strlen = strlen($string);
        if ($strlen < $length) {
            $string = str_pad($string, $length, "0");
        } else if ($strlen > $length) {
            $string = substr($string, 0, $length);
        }
    }

    static function processUrl($url)
    {
        $vjconfig = lib_config::getInstance()->getConfig();

        if ($vjconfig['framework']['seourl']) {
            return true;

            // todo
        } else {
            return $url;
        }
    }

    static function processSeoUrl()
    {
        //$vjconfig = lib_config::getInstance()->getConfig();

        // use either global or by object property
        //$seoparams = getParams();

            //todo
    }

   static function getParams()
    {

        $vjconfig = lib_config::getInstance()->getConfig();

        $params = array();
        $baseUrlCount = strlen($vjconfig['base_url']);
        $url = substr($_SERVER['REQUEST_URI'], $baseUrlCount);
        if ($url == '') {
            return $params;
        }
        $params = explode('/', $url);
        return $params;
    }

    static function getelement($name = 'button', $val = 'button', $attr = array(), $isdualtag = true)
    {

        // $html = $this->vars[$name][$dclass];
        $html = '<' . $name . ' ';

        if ($attr) {
            $html .= self::processAttr($attr);
        }

        if (! $isdualtag) {
            $html .= ' /';
        }
        $html .= '>';

        if ($isdualtag) {
            $html .= $val . '</' . $name . '>';
        }
        return $html;
    }

    static function processAttr($proc = array())
    {
        if (! is_array($proc)) {
            echo $proc . "<br>";
            echo "<pre>";
            echo "Attribute should be array not string";
            print_r($proc);
            die();
        }
        $attributes = "";
        foreach ($proc as $attrkey => $attr) {
            $attribute = '';

            if (! is_array($attr)) {
                $attr = array(
                    "value" => $attr
                );
            }
            if (isset($attr['condition'])) {
                if ($row[$attr['condition']['field']] == $attr['condition']['check']) {
                    $attribute = $attrkey . '=' . '"' . $attr['condition']['value'] . '"';
                }
            } else {
                $attribute = " " . $attrkey . '=' . '"' . $attr['value'] . '"';
            }
            $attributes .= $attribute . ' ';
        }

        return $attributes;
    }

    static function getvardef($table)
    {
        $db = lib_database::getInstance();
        $sql = "select * from tableinfo where name='" . $table . "' and deleted=0";
        $row = $db->getrow($sql);

        if ($row) {

            $moduleinfo = json_decode(base64_decode($row['description']), 1);

            $metadata = isset($moduleinfo['metadata']) ? $moduleinfo['metadata'] : array(
                "metadata" => array()
            );
            if (isset($row['listviewdef']) && $row['listviewdef']) {
                $metadata['listview'] = json_decode($row['listviewdef'], 1);
                foreach ($metadata['listview'] as $key => $field) {
                    if (! is_array($field)) {
                        $metadata['listview'][$key] = $moduleinfo["fields"][$field];
                    }
                }
            }

            if (isset($row['editviewdef']) && $row['editviewdef']) {
                $metadata['editview'] = json_decode($row['editviewdef'], 1);
            }

            if (isset($row['detailviewdef']) && $row['detailviewdef']) {
                $metadata['detailview'] = json_decode($row['detailviewdef'], 1);
            }

            if (isset($row['searchviewdef']) && $row['searchviewdef']) {
                $metadata['searchview'] = json_decode($row['searchviewdef'], 1);
                foreach ($metadata['searchview'] as $key => $field) {
                    if (! is_array($field)) {
                        $metadata['searchview'][$key] = $moduleinfo["fields"][$field];
                    }
                }
            }

            unset($moduleinfo['metadata']);
            return array(
                "fields" => $moduleinfo,
                "metadata" => $metadata
            );
        } else {

            debug_print_backtrace();
            die("entity " . $table . " not found");
        }
    }

    static function getLabel($lbl)
    {
        global $mod_string;
        return isset($mod_string[$lbl]) ? $mod_string[$lbl] : $lbl;
    }

    static function getEntityField($table, $field)
    {
        $globalModuleList = lib_datawrapper::getInstance()->get("module_list");

        if (isset($globalModuleList[$table]) && isset($globalModuleList[$table]['tableinfo']['fields'][$field])) {
            return $globalModuleList[$table]['tableinfo']['fields'][$field];
        }

        return false;
    }

    static function isset($array,...$args) {

        $isValid = true;
        foreach($args as $index) {
            if(!isset($array[$index])) {
                $isValid = false;
                break;
            }
        }
        return $isValid;

    }
}
?>
