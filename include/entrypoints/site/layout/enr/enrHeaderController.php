<?php 
require_once 'controlarea/include/vjlib/abstract/AWidget.php';
require_once 'controlarea/include/vjlib/abstract/APosition.php';
require_once 'include/entrypoints/site/layout/enr/enrPositions.php';
require_once 'controlarea/include/vjlib/libs/bootstrap4/bootstrap4.php';
require_once 'controlarea/include/vjlib/libs/bootstrap4/IBootstrapWidgetConstant.php';


class enrHeaderController extends EntryPointController {
    
    function getMenus() {
        
        
        global $db,$vjconfig;
        
        
        $menus = array();
        
        $menus['exam']['name'] = "Exam";
        $menus['exam']['type'] = "mega";
        $menus['exam']['menu'] = array();
        
        
        
        
        $menus['courses']['name'] = "Courses";
        $menus['courses']['alias'] = $vjconfig['baseurl']."course";
        
        $menus['testseries']['name'] = "Test Series";
        $menus['testseries']['alias'] = $vjconfig['baseurl']."testseries";
        $menus['pass']['name'] = "Pass";
        $menus['pass']['alias'] = $vjconfig['baseurl']."pass";
        
        
        return $menus;
    }
    
    function loadHeader() {
        global $smarty,$current_user,$vjconfig;
        $params = array();
        $params['logo']  =array();
        $params['logo']['src'] = 'assets/enr/images/logo.jpg';
        $params['headermenu'] = $this->getMenus();
        $params['content_right']   = '<div id="gSignIn"></div><div class="userContent" style="display: none;"></div>';
        
        if($current_user && $current_user->id) {
            $params['content_right']   = '<div id="gSignIn" style="display:none;"></div><div class="userContent" style="display: none;"></div>';
            $params['content_right']   .= '<a class="btn btn-danger" href="javascript:void(0);" onclick="signOut()">Logout</a>';
        }
        
        
        $cssAndJs = Bootstrap4::getCssJs();
        $header = Bootstrap4::loadWidgetAtPosition(enrPositions::$TOP_HEADER);
        $header .= Bootstrap4::loadWidget(IBootstrapWidgetConstant::$MEGA_MENU,$params);
        $header .= Bootstrap4::loadWidgetAtPositionByPage(enrPositions::$SLIDER,$params);
        
        $header .= AWidget::loadWidget(IBootstrapWidgetConstant::$BREADCRUMB, $this->bootparams['breadcrumb']);
        
        $smarty->assign("bootstrapcssandjs",$cssAndJs);
        $smarty->assign("header",$header);
        
    }
}
?>