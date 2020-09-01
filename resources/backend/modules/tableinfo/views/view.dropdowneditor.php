<?php

class tableinfoViewDropdownEditor extends ViewBasic
{

    function display()
    {
        global $app_list_strings, $vjlib, $vjconfig;
        $bs = lib_bootstrap::getInstance();
        $rows = array();
        $counter = 0;
        $rowcounter = 0;
        
        foreach ($app_list_strings as $list => $val) {
            $counter ++;
            $list = getelement('a', $list, array(
                'href' => '#',
                'onclick' => "ajaxeditoption('" . $list . "')"
            ));
            
            $rows[$rowcounter][] = $list;
            if ($counter == 4) {
                $counter = 0;
                $rowcounter ++;
            }
        }
        
        for ($j = $counter; $j < 4; $j ++) {
            $rows[$rowcounter][] = "";
        }
        
        $script = getelement('script', '', array(
            "src" => 'modules/tableinfo/assets/layoutmanager.js'
        ));
        $table = $bs->generateTable($rows, array(
            "headers" => array(
                0,
                1,
                2,
                3
            )
        ));
        
        $url = "index.php?module=tableinfo&action=saveoption";
        $url = lib_util::processUrl($url);
        
        $html = $script . $table;
        
        $submit = getelement('button', 'Save', array(
            'type' => 'submit',
            'class' => 'btn btn-primary'
        ));
        
        $button = getelement('button', "Add New", array(
            "class" => 'btn btn-info',
            "onclick" => "newdropdown()"
        ));
        
        $smarty = new Smarty();
        $smarty->assign('heading', 'Options');
        $smarty->assign('body', '');
        $smarty->assign('class', 'info');
        $smarty->assign('isform', true);
        $smarty->assign('footbutton', $submit);
        $smarty->assign('url', $url);
        $basepath = $vjconfig['fwbasepath'];
        $path = $basepath . "include/tpls/modal.tpl";
        $html .= $smarty->fetch($path);
        $html = $button . $html;
        $path = $basepath . "modules/tableinfo/tpls/newdropdownmodal.tpl";
        $html .= $smarty->fetch($path);
        $this->html = $html;
        $this->heading = "Dropdown Editor";
        parent::display();
    }
}

?>

