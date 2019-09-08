<?php
global $vjconfig;
$vjconfig = array();
$vjconfig['basepath'] = __DIR__.'/';

$vjconfig['baseurl'] = 'https://boomerangtrip.com/';

$vjconfig['sitename'] = "Boomerangtrip Control Panel";
$vjconfig['timezone'] = "Asia/Kolkata";

$vjconfig['mysql']['host'] = "localhost";

$vjconfig['mysql']['user'] = "boomerangdemo";

$vjconfig['mysql']['password'] = "boomerangtrip";

$vjconfig['mysql']['database'] = "boomerangtripdemo";


$vjconfig['framework']['default_module'] = "user";
$vjconfig['framework']['default_action'] = "login";

//$vjconfig['framework']['default_mode'] = "entryPoint";
//$vjconfig['framework']['default_entrypoint'] = "site";

$vjconfig['framework']['after_login_module'] = "user";
$vjconfig['framework']['after_login_action'] = "home";

$vjconfig['framework']['seourl'] = false;
$vjconfig['defaultlang'] = 'en_us';

$vjconfig['urlbasepath'] = "/";

$vjconfig['adminemail'][] = "deepak.cleo@gmail.com";

$vjconfig['sitetpl'] = "brtv2";

$vjconfig['tbocredentials'] = array(
    "ClientId" => "tboprod",
    "UserName"=> "DELF251",
    "Password"=> "travel//18@@"
    );

$vjconfig['tbojsonmode'] = false;
$vjconfig['apivalidation'] = true;

if($_SERVER['HTTP_HOST']=="localhost") {
    
    $vjconfig['tbojsonmode'] = true;
    $vjconfig['baseurl'] = 'http://localhost/spider-php/';
    $vjconfig['urlbasepath'] = "/spider-php/";
    $vjconfig['mysql']['user'] = "root";
    $vjconfig['mysql']['password'] = "root";
    $vjconfig['mysql']['database'] = "boomerangtripdemo";
    $vjconfig['sitetpl'] = "brtv2";
    
} else if($_SERVER['HTTP_HOST'] == 'papajourney.com') {
    $vjconfig['baseurl'] = 'https://papajourney.com/';
    $vjconfig['urlbasepath'] = "/";
    $vjconfig['mysql']['user'] = "fareglobal";
    $vjconfig['mysql']['password'] = "fare@123";
    $vjconfig['mysql']['database'] = "papajourneydb";
    $vjconfig['sitename'] = "Papajourney Control Panel";
    $vjconfig['sitetpl'] = "papa";
    $vjconfig['tbocredentials'] = array(
        "ClientId" => "tboprod",
        "UserName"=> "DELF221",
        "Password"=> "tbolive-19/@@"
    );
}

else if($_SERVER['HTTP_HOST'] == 'fareglobal.com') {
    $vjconfig['baseurl'] = 'https://fareglobal.com/';
    $vjconfig['urlbasepath'] = "/";
    $vjconfig['mysql']['user'] = "fareglobal";
    $vjconfig['mysql']['password'] = "fare@123";
    $vjconfig['mysql']['database'] = "fareglobal";
    
    /*$vjconfig['mysql']['user'] = "faregzii_fare";
    $vjconfig['mysql']['password'] = "fare@123";
    $vjconfig['mysql']['database'] = "faregzii_fareglobal";
     $vjconfig['mysql']['host'] = "boomerangtrip.com";
    $vjconfig['mysql']['user'] = "boomerangdemo";
    $vjconfig['mysql']['password'] = "boomerangtrip";
    $vjconfig['mysql']['database'] = "fareglobalsite";
     */
    $vjconfig['sitename'] = "Fareglobal Control Panel";
    $vjconfig['sitetpl'] = "fareglobal";
    
    $vjconfig['tbocredentials'] = array(
        "ClientId" => "tboprod",
        "UserName"=> "DELF221",
        "Password"=> "tbolive-19/@@"
    );
} else if($_SERVER['HTTP_HOST'] == 'eticketfares.com') {
    $vjconfig['baseurl'] = 'https://eticketfares.com/';
    $vjconfig['urlbasepath'] = "/";
    $vjconfig['mysql']['user'] = "eticketfare";
    $vjconfig['mysql']['password'] = "eticketfare@123";
    $vjconfig['mysql']['database'] = "eticketfare";
    $vjconfig['sitename'] = "EticketFares Control Panel";
    $vjconfig['sitetpl'] = "etf";
    
} else if($_SERVER['HTTP_HOST'] == 'flightwikipedia.com') {
    $vjconfig['baseurl'] = 'http://flightwikipedia.com/';
    $vjconfig['urlbasepath'] = "/";
    $vjconfig['mysql']['user'] = "flightwikipedia";
    $vjconfig['mysql']['password'] = "12q12q12q";
    $vjconfig['mysql']['database'] = "altflightwikipedia";
    $vjconfig['sitename'] = "Flightwikipedia Control Panel";
    $vjconfig['sitetpl'] = "fwp";
    
} else if($_SERVER['HTTP_HOST'] == 'boomerangvacations.com') {
    
    $vjconfig['baseurl'] = 'https://boomerangvacations.com/';
    $vjconfig['urlbasepath'] = "/";
    $vjconfig['mysql']['user']= "boomerangvacatio";
    $vjconfig['mysql']['password'] = "boom@123";
    $vjconfig['mysql']['database'] = "altboomerangvacations";
    $vjconfig['sitename'] = "Boomerangvacations Control Panel";
    $vjconfig['sitetpl'] = "bvac2";
    
}else if($_SERVER['HTTP_HOST'] == 'boomerangtrip.com') {
    $vjconfig['tbojsonmode'] = false;
    $vjconfig['disableLiveFare'] = true;
    
    $vjconfig['apivalidation'] = true;
    //$vjconfig['fbwebhookappaccesstoken'] = '325428614824405|_z1kYXIK-Dik_fF6Qi2jmyycICE';
//    $vjconfig['fbwebhookappaccesstoken'] = 'EAAq5kJLntXIBAIjVOBZBMED5vl9GvZBsXatpO75r9vpHiEIOfTg9XhdPgo9Yw5XirFwLyxT3UfQJPB3D4QLVxOo3q7aMhWTCFWZBu6aTQEnq7GrtXkKV8lmfB8wvYuP4sOafnU7gFj5MnwJ8JwPvXQiSlO5tiaJVzDR3d62XmPEHDr39tc48xaBFpZCHIt8ZD';
 //     $vjconfig['fbwebhookappaccesstoken'] = 'EAAq5kJLntXIBADvEwTsIaCo4AcjQ69LY7dtOZCaWsXKrq9gXV3ZAhoEEqD96pr0NBTzCV6ZABW5ZBA7A40BWItk6AWF5xubjWHj7E7ZA5wgwFXMBsDVx5RMF1MvvlBxZAZCRZAVNKL5mWazAP2nZCt43y0qRLYnqzGTKTAUEcGWkCXNnozo1TAKtY7RcCsSa59BOXIPasBhdiFAZDZD';
  //    $vjconfig['fbwebhookappaccesstoken'] = 'EAAq5kJLntXIBAAQF5XsrgWS7fjMELkW28qMa50DF30adSw61ICx5qQiiQB9zV9ZBdPm3wpYQ0DBQpYIzienYI253MI3vDxsALFWDnhGjynpBQviK3hdTC5OZBxDpfweEbtAFHbQedP8UifRUNK0hU7JTr99Ln9Yq00cX0ZAfPElwVYi36mB7uxOjFEF12oz0kSn3dPE4wZDZD';
      $vjconfig['fbwebhookappaccesstoken'] = 'EAAq5kJLntXIBALg6nPErNNtcJGST4QvYsjQ0gkZB5YcnOIsebbVwgov7RIA8LOglkRWs3VCuOh3ZCdje2bCULxID8bbKBqrIA9ZATEWZCXirdaHlhOWekz388AvQeWUSc9QZBCLXRLVG7QSSdyu8g1b2xWByiV5GfSH56AJhfZCLVchZCKx0R48';
}



