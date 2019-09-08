<?php 

function processSeoParams($index,$pointer,$debug = false) {
    
    
    foreach($pointer[$index]['params'] as $key=>$val) {
        if(!isset($_REQUEST[$key])) {
            $_REQUEST[$key] = $val;
        }
        if(isset($pointer[$index]['child'])  ) {
            $pointer = $pointer[$index]['child'];
        }
    }
    return $pointer;
}

global $vjconfig,$seoConfig;
$httpProtocol = "http";
if(isset($_SERVER['HTTPS'])) {
    $httpProtocol = "https";
}
if(!isset($_SERVER['REQUEST_URI'])) {
    $_SERVER['REQUEST_URI'] = $vjconfig['baseurl'];
}
$url = $httpProtocol . "://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
$canurlArray =explode("?",$url);
$url = str_replace($vjconfig['baseurl'],"", $url);
 
$strArray = explode("?",$url);
$url = $strArray[0];
$_REQUEST['canonicalurl'] = $canurlArray[0];
$seoParams = explode("/",$url);
$pointer = $seoConfig;
foreach($seoParams as $index=>$param) {
    if(empty($param)) {
       break;
    } else {
        if(isset($pointer[$seoParams[$index]])) {
            
            $pointer = processSeoParams($seoParams[$index], $pointer);
            
        } else {
            $splitArray = explode("-",$seoParams[$index]);
            if(isset($pointer[$splitArray[0]])       ) {
                $seoParams[$index] = substr($seoParams[$index], (strlen($splitArray[0])+1));
               
                $pointer = processSeoParams($splitArray[0], $pointer,true);
                
            } else if(empty($_GET)) {
                $pointer = processSeoParams('default', $pointer);
                
            }
            
        }
    }
}



?>