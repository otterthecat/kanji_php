<?php

/**
 * @author David Lally
 * @copyright 2010
 */

class Api_Bitly{
    
    
    //     PROPETIES
    //////////////////////////////////////////////////////////////////
    
    private $bitly_shorten_url              = "http://api.bit.ly/v3/shorten?login=%s&apiKey=%s&longURL=%s";
    private $bit_login                      = ""; // login given by bit.ly
    private $bit_apiKey                     = ""; // apiKey given by bit.ly
    private $target_url                     = ""; // url to be shortened
    private $full_shorten_url               = ""; // generated below                    
    
    
    
    //     METHODS
    //////////////////////////////////////////////////////////////////
    
    
    public function __construct($login_str="", $apikey_str="", $target_str="")
    {
        
        $this->bit_login                    = $login_str;
        $this->bit_apiKey                   = $apikey_str;
        $this->target_url                   = $target_str;
        
        return                                $this;
        
    }// end constructor ----------------------------------------------------------------------------------------------------------- end constructor
    
    
    
    public function setLogin($login_string)
    {
        $this->bit_login                    = $login_string;
        return                                $this;
        
    }// end setLogin -------------------------------------------------------------------------------------------------------------- end setLogin
    
    
    
    public function setApiKey($key_string)
    {
        
        $this->bit_apiKey                  = $key_string;
        return                               $this;
        
    }// end setApiKey ------------------------------------------------------------------------------------------------------------- end setApiKey
    
    
    
    public function setTargetUrl($target_string)
    {
        
        $this->target_url                  = $target_string;
        return                               $this; 
        
    }// end setTargetUrl -------------------------------------------------------------------------------------------------------- end setTargetUrl
    
    
    
    public function shorten($format="json")
    {
        
        $this->concatURL();
        $result                            = $this->doCurl();
        
        switch($format)
        {
            case "json":
            
                return                       $result;
            
                break;
                
            case "object":
            
                return                       json_decode($result);
            
                break;
                
            case "array":
            
                return                       (array) json_decode($result);
            
                break;
                
            case "xml":
            
                return                       $result; /*TO DO: insert code to return data as XML or remove this option */
                
                break;
            
            default:
            
                echo 						"Invalid return type entered for Bitly::getResult";
                
                break;
        }
        
        
    }// end shorten ------------------------------------------------------------------------------------------------------------- end shorten;
    
    
    
    private function concatURL()
    {
        
        $this->full_shorten_url               = sprintf($this->bitly_shorten_url, $this->bit_login, $this->bit_apiKey, $this->target_url);
            
        return                                $this->full_shorten_url;
        
        
    }// end concatURL ----------------------------------------------------------------------------------------------------------- end concatURL
    
    
    
    private function doCurl()
    {
        $curl                               = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->full_shorten_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        
        $result                       = curl_exec($curl);

        curl_close($curl);
        
        
        return                              $result;         
        
    }// end doCurl ---------------------------------------------------------------------------------------------------------------- end doCurl
    
    
    
}// end class --------------------------------------------------------------------------------------------------------------------- end class

/* end file
*/