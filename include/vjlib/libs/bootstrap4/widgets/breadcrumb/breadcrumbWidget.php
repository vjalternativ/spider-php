<?php
class breadcrumbWidget extends AWidget {
    public function processWidgetParams($params)
    {

        global $vjconfig;
        if(is_array($params)) {
        $foundkey = false;

        $alias = $vjconfig['baseurl'];

        $alias  = substr($alias,0,-1);
        if(isset($params['prefix'])) {
            $alias .= $params['prefix'];

        }

        foreach($params as $key=>$val) {
            $foundkey = $key;
            $params[$key] = $val;
            if(isset($val['alias']) && $val['alias']) {
                $alias .= "/".$val['alias'];
            }
            $val['link'] = $alias;

            echo "<pre>";debug_print_backtrace();die;

            $params[$key] = $val;

        }



            $params[$foundkey]['islast'] = true;


        }

        return $params;
    }


}