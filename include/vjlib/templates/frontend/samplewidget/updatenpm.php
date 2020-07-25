<?php 
$jsonstring = file_get_contents("package.json");
$json = json_decode($jsonstring,1);

foreach($json as $key=>$value) {
    if(substr($key, 0,1)=="_") {
        unset($json[$key]);
    }
}
unset($json['dist']);

$version = $json['version'];
$strarray = explode(".",$version);
//changing patch version
$strarray[2]++;
$version = implode(".",$strarray);
$json['version'] = $version;
file_put_contents("package.json", json_encode($json));
?>