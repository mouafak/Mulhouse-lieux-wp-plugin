<?php


class MapBoxAPI
{
    private $accessToken;

    private $apiUrl;
    
    private $s;

    function __construct()
    {
        
    }

    /**
     * Get the value of accessToken
     */ 
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Set the value of accessToken
     *
     * @return  self
     */ 
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * Get the value of apiUrl
     */ 
    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * Set the value of apiUrl
     *
     * @return  self
     */ 
    public function setApiUrl($apiUrl)
    {
        $this->apiUrl = $apiUrl;

        return $this;
    }

    /**
     * Get the value of s
     */ 
    public function getS()
    {
        return $this->s;
    }

    /**
     * Set the value of s
     *
     * @return  self
     */ 
    public function setS($s)
    {
        $this->s = $s;

        return $this;
    }
}