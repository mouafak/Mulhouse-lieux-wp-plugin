<?php


class MapBoxAPI
{
    private $accessToken;

    private $adresse;

    public $result=[];

    function __construct($adresse)
    {
        // $this->accessToken = get_option("setting_api_key");
        $this->setAccessToken();

        $this->adresse = $adresse;

        $this->callApiMapBox();

    }

    private function setAccessToken() {
        
        if(! get_option("setting_api_key")){
            return;
        }
        if(empty(get_option("setting_api_key")) ){
            return;
        }
        

        $this->accessToken = get_option("setting_api_key");
    }

    /**
     * Get the value of result
     */ 
    public function getResult()
    {
        return $this->result;
    }


    private function callApiMapBox(){

        $apiUrl = 'https://api.mapbox.com/geocoding/v5/mapbox.places/'. str_replace(" ","%20", $this->adresse) .'.json?access_token='.$this->accessToken.'&imit=1';

        $cURL = curl_init($apiUrl);
        curl_setopt_array($cURL , [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 1
        ]);

        $data = curl_exec($cURL);


        if($data === false){
            return curl_error($cURL);
        }
        if(curl_getinfo($cURL , CURLINFO_HTTP_CODE) !== 200){
            return curl_error($cURL);
        }
        
        $data = json_decode($data , true);

        curl_close($cURL);

        $geometry = $data["features"][0]["geometry"]["coordinates"];
        $center = $data["features"][0]["center"];

        $this->result = [$geometry , $center];
                    

    }
}