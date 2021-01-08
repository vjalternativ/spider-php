<?php

class lib_bootstrap
{

    public $vars = array();

    public $colors = array(
        "success",
        "info",
        "warning",
        "danger"
    );

    private $data;

    public $html = '';

    private static $instance = null;

    function __construct()
    {
        $this->vars['classes'] = array(
            'primary',
            'info',
            'warning',
            'success',
            'default',
            'danger'
        );
        $this->vars['panel'] = $this->getpanel();
        $this->vars['rowopen'] = $this->rowopen();
        $this->vars['rowclose'] = $this->rowclose();
        $this->vars['cols'] = $this->getcols();
        $this->vars['colclose'] = $this->rowclose();
        $this->vars['close'] = '</div>';
        $this->vars['alert'] = $this->getalerts();
        $this->vars['jumbotron'] = '<div class="jumbotron">';
        $this->vars['button'] = array();
        $this->vars['clearfix'] = '<div class ="clearfix"></div>';

        foreach ($this->vars['classes'] as $class) {
            $this->vars['button'][$class] = '<button class="btn btn-' . $class . '" ';
        }
    }

    static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new lib_bootstrap();
        }
        return self::$instance;
    }

    function generatePanel($heading = "", $panelbody = "", $panelfooter = "", $class = "info", $id = "")
    {
        $span = array();
        $span['span']['attr'] = array(
            "class" => 'h3'
        );
        $span['span']['content'] = $span;

        $panelheading = array();

        if ($span) {
            $panelheading['div']['attr'] = array(
                "class" => 'panel-heading'
            );
            $panelheading['div']['content'] = $heading;
        } else {
            return false;
        }

        $panel = array();
        $panel['elem'] = 'div';
        $panel['attr'] = array(
            "class" => 'panel panel-' . $class,
            "id" => $id
        );

        $panel['contents'][] = $panelheading;

        if ($panelbody) {
            $panelBodyEle = array();
            $panelBodyEle['div']['attr'] = array(
                "class" => 'panel-body'
            );
            $panelBodyEle['div']['content'] = $panelbody;

            $panel['contents'][] = $panelBodyEle;
        }
        if ($panelfooter) {
            $panel['contents'][] = $panelfooter;
        }

        return $this->processhtml($panel);
    }

    function processAttr($proc = array())
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

    // TO DO : make generic function for process element
    function getelements($elementarray = array())
    {}

    function getelement($name = 'button', $val = 'button', $attr = array(), $isdualtag = true)
    {

        // $html = $this->vars[$name][$dclass];
        $html = '<' . $name . ' ';

        if ($attr) {
            $html .= $this->processAttr($attr);
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

    function getalerts()
    {
        $alert = array();
        foreach ($this->vars['classes'] as $color) {
            $alert[$color] = '<div  class="alert alert-' . $color . '">
  	<strong>Info!</strong>';
        }
        return $alert;
    }

    function panelopen()
    {
        $array = array();
        foreach ($this->vars['classes'] as $class) {
            $html = '<div class="panel panel-' . $class . '">';
            $array[$class] = $html;
        }

        return $array;
        // return $html;
    }

    function headopen()
    {
        $html = '<div class="panel-heading">';
        return $html;
    }

    function headclose()
    {
        $html = '</div>';
        return $html;
    }

    function bodyopen()
    {
        $html = '<div class="panel-body">';
        return $html;
    }

    function bodyclose()
    {
        $html = '</div>';
        return $html;
    }

    function footopen()
    {
        $html = '<div class="panel-footer">';
        return $html;
    }

    function footclose()
    {
        $html = '</div></div>';
        return $html;
    }

    function getpanel()
    {
        $panel = array();
        $panel['open'] = $this->panelopen();
        $panel['headopen'] = $this->headopen();
        $panel['headclose'] = $this->headclose();
        $panel['bodyopen'] = $this->bodyopen();
        $panel['bodyclose'] = $this->bodyclose();
        $panel['footopen'] = $this->footopen();
        $panel['footclose'] = $this->footclose();

        return $panel;
    }

    function rowopen()
    {
        $html = '<div class="row">';
        return $html;
    }

    function rowclose()
    {
        $html = "</div>";
        return $html;
    }

    function colopen($width, $offset = false)
    {
        // <div class="col-md-3">
        $html = '<div class="col-md-' . $width . '">';
        if ($offset) {
            $html = '<div class="col-md-' . $width . ' col-md-offset-' . $offset . '">';
        }
        return $html;
    }

    function colclose()
    {
        $html = "</div>";
        return $html;
    }

    function getcols()
    {
        $cols = array();
        for ($i = 1; $i <= 12; $i ++) {
            $cols[$i] = $this->colopen($i);
            for ($j = 11; $j >= 1; $j --) {
                $cols['off'][$i][$j] = $this->colopen($i, $j);
            }
        }

        return $cols;
    }

    function panel($headingcontent, $bodycontent, $footercontent)
    {
        $heading = $bs->getelement('div', $headingcontent, array(
            'class' => 'panel-heading'
        ));
        $body = $bs->getelement('div', $bodycontent, array(
            'class' => 'panel-body'
        ));
        $footer = $bs->getelement('div', $footercontent, array(
            'class' => 'panel-heading'
        ));
    }

    // params -> headers,extra,class
    function generateTable($rows, $params = array(), $log = 0)
    {
        $headers = isset($params['header']) ? $params['header'] : array();
        $extra = isset($params['extra']) ? $params['extra'] : array();
        $class = "table-striped";

        foreach ($params as $key => $val) {
            $$key = $val;
        }

        $trclass = '';
        $tbId = '';

        $tdwidth = isset($params['tdwidth']) ? $params['tdwidth'] : false;

        if (! empty($params['tbid'])) {
            $trclass = $params['tbid'];
            $tbId = 'id="' . $params['tbid'] . '"';
        }

        $html = '<table ' . $tbId . ' class="table ' . $class . '">
    <thead>
      <tr>
	';

        $isTwoDim = false;
        $labels = array_values($headers);
        foreach ($labels as $label) {
            if (isset($label['label'])) {
                $isTwoDim = true;
            }
            break;
        }

        if ($labels !== $headers || ! $isTwoDim) {
            foreach ($labels as $head) {
                $html .= '<td><b>' . ucfirst($head) . '</b></td>';
            }
        } else {

            $headers = array();

            foreach ($labels as $key => $head) {
                $headers[] = $head['name'];
                $html .= '<td><b>' . ucfirst($head['label']) . '</b></td>';
            }
        }

        foreach ($extra as $cell => $label) {
            $html .= '<td><b>' . ucfirst($cell) . '</b></td>';
        }
        $html .= '</tr></thead><tbody id="' . $trclass . '-body">';
        $counter = 0;
        foreach ($rows as $row) {
            $html .= '<tr id="' . $trclass . '-' . $counter . '" class="' . $trclass . '-row">';


            if($headers ){
                foreach ($headers as $cell => $label) {

                    if (! isset($row[$label])) {
                        $row[$label] = '';
                    }
                    $html .= '<td>' . $row[$label] . '</td>';
                }
            } else {
                foreach($row as $col) {
                    if($tdwidth) {
                        $html .= '<td width="'.$tdwidth.'"> ' . $col . '</td>';

                    } else {
                        $html .= '<td > ' . $col . '</td>';

                    }
                }
            }


            foreach ($extra as $cell => $label) {

                if (isset($row['id'])) {
                    $html .= '<td>' . str_replace('RID', $row['id'], str_replace("ROWID", $trclass . '-' . $counter, $label)) . '</td>';
                } else {
                    $html .= '<td>' . $label . '</td>';
                }
            }

            $counter ++;

            $html .= '</tr>';
        }

        $html .= '</tbody></table>';
        return $html;
    }

    function processhtml($element = array())
    {
        $html = '';
        $elem = "div";
        if (isset($element['elem'])) {
            $elem = $element['elem'];
        }

        $tags = array();
        if (isset($element['contents'])) {
            $tags = $element['contents'];
        }

        foreach ($tags as $key => $tag) {

            if (is_array($tag)) {
                $html .= $this->process($tag);
            } else {
                $html .= $tag;
            }
        }

        $attr = array();
        if (isset($element['attr'])) {
            $attr = $element['attr'];
        }

        $finalhtml = $this->getelement($elem, $html, $attr);
        return $finalhtml;
    }

    function process($htmlarray = array())
    {
        if (isset($htmlarray['contents'])) {
            return $this->processhtml($htmlarray);
        }
        foreach ($htmlarray as $element => $html) {
            if (isset($html['contents'])) {
                return $this->processhtml($html);
            }

            $isdualtag = true;
            if (isset($html['isdualtag'])) {
                $isdualtag = $html['isdualtag'];
            }

            $attr = array();
            if (isset($html['attr'])) {
                $attr = $html['attr'];
            }

            if (isset($html['content']) && is_array($html['content'])) {

                return $this->getelement($element, $this->process($html['content']), $attr, $isdualtag);
            } else {

                if (! isset($html['attr'])) {
                    $html['attr'] = array();
                }

                return $this->getelement($element, $html['content'], $html['attr'], $isdualtag);
            }
        }
    }

    function getVars(){
        return $this->vars;
    }
}

?>