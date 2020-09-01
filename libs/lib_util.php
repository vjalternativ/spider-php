<?php

class lib_util
{

    function redirect($module, $action = false, $params = array())
    {
        $string = "index.php?module=" . $module;
        if ($action) {
            $string .= "&action=" . $action;
        }
        foreach ($params as $key => $val) {
            $string .= "&" . $key . "=" . $val;
        }
        header('location:' . $string);
        exit();
    }

    function sessioncheck($var)
    {
        if (! isset($_SESSION[$var])) {
            return false;
        }

        // return $_SESSION[$var];
        if ($var == 'current_user') {
            $array = json_decode($_SESSION[$var], 1);

            global $current_user;
            $obj = new Entity();
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

    function create_guid()
    {
        $microTime = microtime();
        list ($a_dec, $a_sec) = explode(" ", $microTime);

        $dec_hex = dechex($a_dec * 1000000);
        $sec_hex = dechex($a_sec);

        ensure_length($dec_hex, 5);
        ensure_length($sec_hex, 6);

        $guid = "";
        $guid .= $dec_hex;
        $guid .= create_guid_section(3);
        $guid .= '-';
        $guid .= create_guid_section(4);
        $guid .= '-';
        $guid .= create_guid_section(4);
        $guid .= '-';
        $guid .= create_guid_section(4);
        $guid .= '-';
        $guid .= $sec_hex;
        $guid .= create_guid_section(6);

        return $guid;
    }

    function create_guid_section($characters)
    {
        $return = "";
        for ($i = 0; $i < $characters; $i ++) {
            $return .= dechex(mt_rand(0, 15));
        }
        return $return;
    }

    function ensure_length(&$string, $length)
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
        global $vjconfig;
        if ($vjconfig['framework']['seourl']) {
            return true;

            // todo
        } else {
            return $url;
        }
    }

    static function processSeoUrl()
    {
        global $seoparams, $vjconfig;
        // use either global or by object property
        $seoparams = getParams();

        if (count($seoparams) == 1) {
            $this->module = $vjconfig['framework']['single_param_module'];
            $this->action = $vjconfig['framework']['single_param_action'];
        } else if (count($seoparams) > 1) {
            $this->module = $seoparams[0];
            $this->action = $seoparams[1];
        }
    }

    function getParams()
    {
        global $sugar_config, $current_url;
        $params = array();
        $baseUrlCount = strlen($sugar_config['base_url']);
        $url = substr($_SERVER['REQUEST_URI'], $baseUrlCount);
        $current_url = $url;
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
        $db = lib_mysqli::getInstance();
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

    function getLabel($lbl)
    {
        global $mod_string;
        return isset($mod_string[$lbl]) ? $mod_string[$lbl] : $lbl;
    }

    function getEntityField($table, $field)
    {
        global $globalModuleList;
        if (isset($globalModuleList[$table]) && isset($globalModuleList[$table]['tableinfo']['fields'][$field])) {
            return $globalModuleList[$table]['tableinfo']['fields'][$field];
        }

        return false;
    }
}
?>
