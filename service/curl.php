<?php


class CurlRequest
{
	
	/**
	 * This function will sync project module data with dcs with base 64 encode form
	 * @param String $method
	 * @param Array $parameters
	 * @param String $url
	 * @return mixed
	 */
	
	function call($url, $post,$header=array())
	{
	    $curl = curl_init();
	    
	    curl_setopt_array($curl, array(
	        CURLOPT_URL => $url,
	        CURLOPT_RETURNTRANSFER => true,
	        CURLOPT_ENCODING => "",
	        CURLOPT_MAXREDIRS => 10,
	        CURLOPT_TIMEOUT => 300,
	        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	        CURLOPT_CUSTOMREQUEST => "POST",
	        CURLOPT_POSTFIELDS => $post,
	        CURLOPT_HTTPHEADER =>$header
	    ));
	    
	    $response = curl_exec($curl);
	    $err = curl_error($curl);
	    
	    curl_close($curl);
	    
		
	    return $response;
	}
	
}


?>