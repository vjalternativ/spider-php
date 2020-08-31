<?php 
ini_set("display_errors",1);
error_reporting(E_ALL);
require_once 'service/tborestservice.php';


$tbo = new TboRestService();

$data =array(
    "EndUserIp" => $tbo->clientIp,
    "TokenId" => $tbo->auth['TokenId'],
    "JourneyType" => "1",
    "PreferredAirlines" => null,
    "Segments" =>array(array(
        "Origin" => "DEL",
        "Destination" => "BOM",
        "FlightCabinClass" => "1",
        "PreferredDepartureTime" => "2018-11-20T00:00:00",
    )),
    "Sources"=> null
 
    
);



$url = 'https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/GetCalendarFare/';


$tbo->setLogPath("calfare");

$response = $tbo->request($url, $data,true);
echo "<pre>";
print_r($response);
die();

?>