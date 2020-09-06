<?php
class ResourceController {



    protected $resource;
    protected $module;
    protected $params = array();

    function __construct() {
        $reflector = new ReflectionObject($this);
        $str = $reflector->getFileName();
        $str = str_replace("modules/","",$str);
        $str = substr($str,0,strrpos($str,"/"));
        $this->module = substr($str,(strrpos($str,"/")+1));
        $str = substr($str,0,strrpos($str,"/"));
        $this->resource = substr($str,(strrpos($str,"/")+1));
    }



    protected function getRealPath($dir,$isFile=false) {
        $libConfig = lib_config::getInstance();
        $path = $libConfig->get("basepath").$dir;
        $fwpath= $libConfig->get("fwbasepath").$dir;
        if($isFile) {
            if(file_exists($path)) {
                return $path;
            } else if(file_exists($fwpath)) {
                return $fwpath;
            }
        } else {
            if(is_dir($path)) {
                return $path;
            } else if(is_dir($fwpath)) {
                return $fwpath;
            }
        }

        return false;
    }

    function rendorTpl($tpl, $params = array(),$sitetpl=false)
    {
        $smarty =  lib_smarty::getSmartyInstance();
        $vjconfig= lib_config::getInstance()->getConfig();



        $params =$this->params ? array_merge($params, $this->params) : $params;
        $smarty->assign("params", $params);
        $smarty->assign("baseurl", $vjconfig['baseurl']);
        $siteTpl = $sitetpl ? $sitetpl : $vjconfig['sitetpl'];


        $this->params['controller_path'] = $this->getRealPath('resources/'.$this->resource.'/modules/' . $this->module . '/');

        if($this->params['controller_path']) {

            $tplPath = 'resources/'.$this->resource.'/modules/' . $this->module . '/'. 'tpls/' ;
            $this->params['controller_tpl_path'] = $this->getRealPath($tplPath. $siteTpl . '/');
            if(!$this->params['controller_tpl_path']) {
                $this->params['controller_tpl_path'] = $this->getRealPath($tplPath . 'default/');
            }

            if($this->params['controller_tpl_path']) {
                return $smarty->fetch($this->params['controller_tpl_path'] . $tpl);
            }
        }

        throw new Exception("tpl not configured ".$tpl);



    }

    function getResource() {
        return $this->resource;
    }
    function getModule() {
        return $this->module;
    }
}
?>