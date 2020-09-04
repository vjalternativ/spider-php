<?php
$dir = __DIR__.'/';
require_once $dir.'../../../../libs/lib_bootstrap.php';

class BackendResourceView extends ResourceView {

    function display() {

        $entity = lib_entity::getInstance();
        $smarty = lib_smarty::getSmartyInstance();
        $entity->module = $this->module;



        if($this->record) {

            $this->data = $entity->get($this->module,$this->record);
        }



        foreach($this->params as $key=>$val) {
            $smarty->assign($key,$val);
        }

        echo $smarty->fetch($this->tpl);
    }

    function getAllMenu() {
        $db = lib_mysqli::getInstance();
        $current_user = lib_current_user::getEntityInstance();
        if(!$current_user) {
            return array();
        }
        if(!$current_user->isDeveloper) {
            if(!$current_user->role_id) {
                return array();
            }
        }
        $roleModules = array();
        if(!$current_user->isDeveloper) {
            $sql = "SELECT * from roles_item
                WHERE deleted=0 and role_id = '".$current_user->role_id."'
                ";
            $roleModules  = $db->fetchRows($sql,array("module_id"));
        }
        $sql = "select m.id as menu_id,m.name as menu_name,t.* from menu_tableinfo_1_m mt
                INNER JOIN menu m on mt.menu_id=m.id and m.deleted=0 and mt.deleted=0
                INNER JOIN tableinfo t on mt.tableinfo_id = t.id and t.deleted=0 ";
        $menumodules = $db->fetchRows($sql,array("menu_id"=>array("menu_name"),"id"));
        $sql = "select m.id as menu_id,sm.id as submenu_id,m.name as menu_name,sm.name as submenu_name,t.* from
                menu_submenu_1_m ms
                INNER JOIN menu m on ms.menu_id=m.id and m.deleted=0 and ms.deleted=0
                INNER JOIN submenu sm on ms.submenu_id=sm.id and sm.deleted=0
                INNER JOIN submenu_tableinfo_1_m st on sm.id=st.submenu_id and st.deleted=0
                INNER JOIN tableinfo t on st.tableinfo_id = t.id and t.deleted=0 order by ms.date_modified,st.date_modified";

        $submenumodules = $db->fetchRows($sql,array("menu_id"=>array("menu_name"),"submenu_id"=>array("submenu_name"),"id"));


        $module = $this->module;

        $globalModuleList = lib_datawrapper::getInstance()->get("module_list");
        $moduleTableId = isset($globalModuleList[$module]['id']) ? $globalModuleList[$module]['id'] : false;
        $menuData = array();
        foreach($submenumodules as $mid=>$menus) {
            foreach($menus['items'] as $smid=>$modules) {
                foreach($modules['items'] as $mdid => $module) {
                    if($current_user->isDeveloper || isset($roleModules[$mdid])) {
                        if(!isset($menuData[$mid])) {
                            $menuData[$mid]['first_module_name'] = $module['name'];
                        }
                        if(!isset($menuData[$mid]['items'][$smid]['items'][$mdid])) {
                            $menuData[$mid]['items'][$smid]['first_module_name'] = $module['name'];
                        }
                        if($mdid == $moduleTableId) {
                            $menuData[$mid]['isactive_menu']  = true;
                            $menuData[$mid]['items'][$smid]['isactive_submenu']  = true;
                            $this->activeMenuId = $mid;
                            $this->activeSubmenuId = $smid;
                            $this->activeModuleId = $mdid;
                        }
                        $menuData[$mid]['menu_name'] = $menus['menu_name'];
                        $menuData[$mid]['items'][$smid]['submenu_name']  = $modules['submenu_name'];
                        $menuData[$mid]['items'][$smid]['items'][$mdid] = $module;
                    }
                }
            }
        }
        foreach($menumodules as $mid=>$menu) {
            foreach($menu['items'] as $mdid=>$module) {
                if($current_user->isDeveloper || isset($roleModules[$mdid])) {
                    if(!isset($menuData[$mid]['first_module_name']) && !isset($menuData[$mid]['module_items'][$mdid])) {
                        $menuData[$mid]['first_module_name'] = $module['name'];
                    }
                    if($mdid == $moduleTableId) {
                        $menuData[$mid]['isactive_menu']  = true;
                        $this->activeMenuId = $mid;
                        $this->activeModuleId = $mdid;
                    }
                    $menuData[$mid]['menu_name'] = $menu['menu_name'];
                    $menuData[$mid]['module_items'][$mdid] = $module;
                }
            }
        }

        //echo "<pre>";print_r($menuData);die;
        return $menuData;


    }

    function _loadHeader() {
        $current_user = lib_current_user::getEntityInstance();

        $vjconfig = lib_config::getInstance()->getConfig();
        $smarty = lib_smarty::getSmartyInstance();



        $vars  =  lib_bootstrap::getInstance()->getVars();

        $vars['cssList']['bootstrap']= '<link rel="stylesheet" href="'.$vjconfig['fwbaseurl'].'resources/backend/assets/bootstrap/css/bootstrap.min.css" />';
        $vars['cssList']['custom']= '<link rel="stylesheet" href="'.$vjconfig['fwbaseurl'].'resources/backend/assets/css/custom.css" />';



        //$bs->vars['jsList']['jquery']= '<script  href="'.$bs->vars['path'].'js/jquery-3.1.1.min.js" ><script>';

        $logout = false;
        $adminarea = false;
        $href = "index.php?resource=backend&module=user&action=logout";
        //$href = lib_util::processUrl($href);
        if(!empty($current_user->id)) {
            $logout = lib_util::getelement('a','Logout',array('class'=>array('value'=>'btn btn-info pull-right'),'href'=>array('value' => $href)));
            if($current_user->user_type == 'developer') {
                $href = lib_util::processUrl("index.php?module=adminarea&action=home");

                $adminarea = lib_util::getelement('a','Administrator',array('class'=>array('value'=>'btn btn-success margin-right-10 pull-right'),'href'=>array('value' => $href)));
            }
        }


        $this->isLoggedIn = $logout;

        $smarty->assign("bs",$vars);
        $smarty->assign("logout",$logout);
        $smarty->assign("adminarea",$adminarea);
        $smarty->assign("vjconfig",$vjconfig);

        $smarty->assign("baseurl",$vjconfig['baseurl']);
        echo "<script> var baseurl ='".$vjconfig['baseurl']."' </script>";
        echo "<script> var fwbaseurl ='".$vjconfig['fwbaseurl']."' </script>";

        $menudata = $this->getAllMenu();
        $smarty->assign("menudata",$menudata);
        $smarty->assign("activeMenuId",$this->activeMenuId);
        $smarty->assign("activeSubmenuId",$this->activeSubmenuId);
        $smarty->assign("activeModuleId",$this->activeModuleId);
        $smarty->assign("current_user",$current_user);

        echo $smarty->fetch($vjconfig['fwbasepath'].'resources/backend/include/tpls/header.tpl');





    }
    function _loadFooter() {
        $current_user = lib_current_user::getEntityInstance();
        $smarty = lib_smarty::getSmartyInstance();
        $vjconfig = lib_config::getInstance()->getConfig();
        $path = $vjconfig['fwbasepath'];
        $smarty->assign("logout",$this->isLoggedIn);

        if($this->isLoggedIn && isset($current_user->privileges['agent.live.chat'])) {
            $this->showChatContainer = true;
        }
        $smarty->assign("showchatContainer",$this->showChatContainer);
        $smarty->assign("relatemodal",$path."include/vjlib/libs/tpls/relatemodal.tpl");

        echo $smarty->fetch($path.'include/vjlib/libs/tpls/footer.tpl');

    }

    function processDefForLang($suffix,$vardef,$deftype="editview") {
        $globalModuleList = lib_datawrapper::getInstance()->get("module_list");
        $entity = lib_entity::getInstance();
        $langTable = $this->module."_".$suffix;


        if(isset($globalModuleList[$langTable]) && strlen($this->data['id'])==36) {


            $langData  = $entity->get($langTable,$this->data['id']);
            if($langData) {
                $this->data['name_'.$suffix] = $langData['name'];
                $jsonData = json_decode($langData['description'],1);
                if($jsonData) {
                    foreach($jsonData as $key=>$val) {
                        $this->data[$key."_".$suffix] = $val;
                    }
                }

            }

        }

        $newDef = $vardef['metadata'][$deftype];

        foreach($vardef['metadata'][$deftype] as $row) {

            $addTempRow = false;
            $temprow = $row;

            if($row['type']=="row" && isset($row['fields'])) {

                foreach($row['fields'] as $colkey => $col) {
                    if(isset($col['field']) && ($col['field']['type']=="varchar" || $col['field']['type']=="text")) {
                        $addTempRow = true;

                        if(isset($vardef['fields'][$col['field']['name']])) {
                            $tempCol = $vardef['fields'][$col['field']['name']];
                            $tempCol['name'] .= "_".$suffix;
                            $tempCol['extraclass'] = " language_".$suffix;
                            $tempCol['label'] = $tempCol['name'];
                            $vardef['fields'][$tempCol['name']] = $tempCol;
                            $temprow['fields'][$colkey]['field'] = $tempCol;

                        }



                    } else {
                        unset($temprow['fields'][$colkey]);
                    }

                }
            }

            if($addTempRow) {
                $newDef[] = $temprow;
            }
        }

        $vardef['metadata'][$deftype] = $newDef;
        return $vardef;
    }
    public function loadHeader()
    {}

    public function loadFooter()
    {}


}
?>