<?php

class tabWidgetController extends WidgetResourceController
{

    var $checkFirst = true;

    var $id = false;

    var $hasActive = false;

    function __construct($id = false)
    {
        parent::__construct();
        if ($id) {
            $this->params['id'] = $id;
        }
        $this->registerField("sql", "text");
    }

    function addTab($params = array(), $key = false)
    {
        if ($this->checkFirst && ! $this->hasActive) {
            $params['isfirstrow'] = true;
            $this->checkFirst = false;
        }
        if ($key) {
            $this->params['tabs'][$key] = $params;
        } else {
            $this->params['tabs'][] = $params;
        }
    }

    function getWidget()
    {
        return parent::rendorWidget("tab", $this->params);
    }

    public function processWidgetParams($params)
    {
        if (isset($params['config']['hasActive']) && $params['config']['hasActive']) {
            $this->hasActive = true;
        }

        if (isset($params['attrs']['sql'])) {
            $db = lib_database::getInstance();
            $sql = $params['attrs']['sql'];

            $params['tabs'] = $db->fetchRows($sql, array(
                array(
                    "key" => $params['attrs']['primary_id'],
                    "cols" => array(
                        $params['attrs']["tabheader_name_field"]
                    )
                ),
                $params['attrs']['secondary_id']
            ));
            // $params['tabs'] = $db->fetchRows($sql,array( $params['attrs']['primary_id'],$params['attrs']['secondary_id']));
            // echo "<pre>";print_r($params['tabs']);die;
            $checkFirst = true;
            foreach ($params['tabs'] as $key => $val) {
                if ($checkFirst) {
                    $val['isfirstrow'] = true;
                    $checkFirst = false;
                }
                $val['name'] = $val[$params['attrs']["tabheader_name_field"]];
                $params['tabs'][$key] = $val;
            }
        } else if (isset($params['tabs'])) {

            foreach ($params['tabs'] as $key => $tab) {
                $this->addTab($tab, $key);
            }

            unset($params['tabs']);

            foreach ($params as $key => $val) {
                $this->params[$key] = $val;
            }

            return $this->params;
        }

        return $params;
    }
}
?>