<?php


class OpenCypherIVSSL {
    
    protected $private_key="",$iv_length="",$ciphering="";
    
    function __construct($private_key,$ciphering="AES-128-CTR") {
        $this->private_key=$private_key;
        $this->ciphering=$ciphering;
        $this->iv_length=openssl_cipher_iv_length($ciphering);
    }
        
    function encrypt($data,$encryption_iv="",$options=0)
    {
        return openssl_encrypt($data, $this->ciphering, $this->private_key, $options, $encryption_iv); 
    }
        
    function decrypt($data,$decryption_iv="",$options=0)
    {
        return openssl_decrypt ($data, $this->ciphering, $this->private_key, $options, $decryption_iv); 
    }
 
}


