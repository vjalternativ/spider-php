<?php
class CurrencyLib
{
    
    var $rate = array(); 
    var $defaultCurrency = "USD";
    var $isFixedMode = true;
    
    function __construct() {
        $this->rate['USD'] = 0.0141203;
        $this->rate['INR'] = 1;
    }
    
    public function getLocationData($ip) {
        if($ip=='::1') {
            return false;
        }
       
        return unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
        
    }
    
    
    
    function convert($from="INR",$to="INR") {
        
        
        $url = "http://free.currencyconverterapi.com/api/v5/convert?q=".$from."_".$to."&compact=y";
        
        $data =  file_get_contents($url);
        
        return json_decode($data,1);
    }
    
    function convertByIP($amout,$from="INR",$ip=false){
            $currencyData = array();
            $rate = $this->rate["USD"];
            $currencyData['code'] = "USD";
            $currencyData['symbol'] = 'USD $';
            $currencyData['rate'] = $rate;
            $currencyData['amount'] = round($amout*$rate,2);
           return $currencyData;
           
    }
    
    function convertByIPWithAPI($amout,$from="INR",$ip=false){ 
        $tip = $_SERVER['REMOTE_ADDR'];
        if($ip) {
            $tip  = $ip;
        }
        $data = array();
        if(isset($_COOKIE['geolocationdata'])) {
            $data = json_decode($_COOKIE['geolocationdata'],1);
        } else {
            $data  = $this->getLocationData($tip);
            //$_SESSION['geolocationdata'] = $data;
            setcookie("geolocationdata", json_encode($data), time() + (365 * 24 * 60 * 60));
        }
        
        
        $currencyData = array();
        
        $currencyData['code'] =  $data['geoplugin_currencyCode'];
        
        $currencyData['symbol'] = $data['geoplugin_currencySymbol_UTF8'];
        $data['geoplugin_currencyCode'] = "";
        if(empty($data['geoplugin_currencyCode'])) {
            $currencyData['code'] = "USD";
            $currencyData['symbol'] = '$';
            
        }
        $rateData =array();
        if(isset($_COOKIE['currencyrate_data'])) {
            $rateData = json_decode($_COOKIE['currencyrate_data'],1);
            } else {
            $rateData = $this->convert($from,$currencyData['code']);
           // $_SESSION['currencyratedata'] = $rateData;
            setcookie("currencyrate_data", json_encode($rateData), time() + (365 * 24 * 60 * 60));
        }
       
        
        $currencyData['from_code'] = $from;
        $currencyData['from_amount'] = $amout;
    
        $rate = $rateData[$from.'_'.$currencyData['code']]['val'];
        if(isset($this->rate[$currencyData['code']])) {
            $rate =$this->rate[$currencyData['code']];
            $currencyData['symbol'] = $currencyData['code']." ".$currencyData['symbol'];
        } else  {
            $rate =$this->rate['USD'];
            $currencyData['code'] = "USD";
            $currencyData['symbol'] = 'USD $';
        }
        $currencyData['rate'] = $rate;
        $currencyData['amount'] = round($amout*$rate,2);
       return $currencyData;
    }
}



?>
