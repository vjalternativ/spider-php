<?php
class ResourceController {


    function initModules() {

        $dataWrapper = lib_datawrapper::getInstance();
        $globalRelationshipList = lib_datawrapper::getInstance()->get("relationship_list");
        $globalModuleList = lib_datawrapper::getInstance()->get("module_list");
        $globalEntityList = lib_datawrapper::getInstance()->get("entity_list");
        $vjconfig = lib_config::getInstance()->getConfig();
        $entity = lib_entity::getInstance();
        $globalServerPreferenceStoreList = lib_datawrapper::getInstance()->get("server_preference_store_list");
        require_once $vjconfig['fwbasepath'].'resources/backend/include/language/lang.php';
        $langpath = $vjconfig['basepath'].'resources/backend/include/language/lang.php';
        if(file_exists($langpath)) {
            require_once $langpath;
        }

        require_once $vjconfig['fwbasepath'].'include/language/'.$vjconfig['defaultlang'].'.string.php';


        if(file_exists($vjconfig['basepath'].'cache/relationship_list.php')) {

            if(file_exists($vjconfig['basepath'].'cache/relationship_entity_list.php')) {
                require_once $vjconfig['basepath'].'cache/relationship_entity_list.php';
            }
            require_once $vjconfig['basepath'].'cache/relationship_list.php';
            require_once $vjconfig['basepath'].'cache/entity_list.php';
            require_once $vjconfig['basepath'].'cache/module_list.php';

            if(file_exists($vjconfig['basepath'].'cache/server_preference_store_list.php')) {
                require_once $vjconfig['basepath'].'cache/server_preference_store_list.php';
            }

            if($globalModuleList || !isset($_REQUEST['entryPoint']) || $_REQUEST['entryPoint']!="install" ) {
                //  return false;
            }
        }  else {
            $entity->generateCache();
        }
        $dataWrapper->set("entity_list",$globalEntityList);
        $dataWrapper->set("module_list",$globalModuleList);
        $dataWrapper->set("relationship_list",$globalRelationshipList);
        $dataWrapper->set("server_preference_store_list",$globalServerPreferenceStoreList);
    }

    function __construct() {
        $this->initModules();
    }

    function rendorTpl($tpl, $params = array(),$sitetpl=false)
    {
        $smarty =  lib_smarty::getSmartyInstance();
        $vjconfig= lib_config::getInstance()->getConfig();

        $params += $this->params;
        $smarty->assign("params", $params);
        $smarty->assign("baseurl", $vjconfig['baseurl']);
        $class = get_called_class();
        $class = str_replace("Controller", "", $class);
        $siteTpl = $sitetpl ? $sitetpl : $vjconfig['sitetpl'];
        $this->params['controller_path'] = 'resources/'.$_GET['resource'].'/modules/' . $_GET['module'] . '/';
        $this->params['controller_tpl_path'] = 'resources/'.$_GET['resource'].'/modules/' . $_GET['module'] . '/tpls/' . $siteTpl . '/';

        return $smarty->fetch($this->params['controller_tpl_path'] . $tpl);
    }
}
?>