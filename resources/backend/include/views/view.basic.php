<?php

class ViewBasic extends BackendResourceView
{

    public $html = false;

    public $heading = false;

    public $tpl = 'include/tpls/basicview.tpl';

    function display()
    {

        if (! $this->heading) {
            $this->heading = $this->module;
        }

        $bs = lib_bootstrap::getInstance();
        if (! $this->html) {

            $this->html = $this->module;
        }

        $panelheading = $bs->getelement('div', ucfirst($this->heading) . ' | Basic View', array(
            'class' => array(
                'value' => 'panel-heading'
            )
        ));
        $panelbody = $bs->getelement('div', $this->html, array(
            'class' => array(
                'value' => 'panel-body'
            )
        ));
        $panelfooter = $bs->getelement('div', '', array(
            'class' => array(
                'value' => 'panel-footer'
            )
        ));
        $panel = $bs->getelement('div', $panelheading . $panelbody, array(
            'class' => array(
                'value' => 'panel panel-info'
            )
        ));
        $this->params = array(
            'module' => $this->module,
            'panel' => $panel
        );
        parent::display();
    }
}

?>