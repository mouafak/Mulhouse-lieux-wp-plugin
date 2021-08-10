<?php


class MapBoxAPI
{
    private $accessToken = "pk.eyJ1IjoibW91YWZhayIsImEiOiJja3MxbnN6dXUxdm55MnZuOHFpMjU1eTVnIn0.7Mx_gCUL5fUWYZFPt5KQqQ";

    private $adresse;

    public $result=[];

    function __construct($adresse)
    {
        $this->adresse = $adresse;
        $this->callApiMapBox();

    }

    /**
     * Get the value of result
     */ 
    public function getResult()
    {
        return $this->result;
    }


    private function callApiMapBox(){
        // $adresse = str_replace(" " , "%" , $this->adresse);

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