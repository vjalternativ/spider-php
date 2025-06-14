<?php

class lib_curl
{

    private $responseCode;

    /**
     *
     * @return mixed
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }

    /**
     *
     * @param mixed $responseCode
     */
    public function setResponseCode($responseCode)
    {
        $this->responseCode = $responseCode;
    }

    function __construct()
    {}

    /**
     * This function will sync project module data with dcs with base 64 encode form
     *
     * @param String $method
     * @param Array $parameters
     * @param String $url
     * @return mixed
     */
    function call($url, $method = "GET", $data = "", $headerList = array())
    {
        $curl = curl_init();

        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 300,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => $headerList
        );

        if ($method == "POST") {
            $options[CURLOPT_POSTFIELDS] = $data;
        }
        curl_setopt_array($curl, $options);

        $response = curl_exec($curl);
        $responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        $err = curl_error($curl);
        if ($err) {
            print_r($err);
            die();
        }
        curl_close($curl);

        $this->setResponseCode($responseCode);

        return $response;
    }

    function get($url, $header = array())
    {
        $headerList = array();
        if ($header) {
            foreach ($header as $key => $val) {
                $headerList[] = $key . ':' . $val;
            }
        }
        return $this->call($url, "GET", "", $headerList);
    }

    function post($url, $payload, $headerList = array())
    {
        return $this->call($url, "POST", $payload, $headerList);
    }
}

?>