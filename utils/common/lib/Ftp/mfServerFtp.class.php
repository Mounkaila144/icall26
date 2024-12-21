<?php


class mfServerFtp {
    
    protected $host="",$port=21,$password="",$user="";
    
    function __construct($host,$user,$password,$port=21) {
        $this->host=$host;
        $this->port=$port;
        $this->user=$user;
        $this->password=$password;
    }
    
    function getHost()
    {
        return $this->host;
    }
    
    function getPort()
    {
        return $this->port;
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function getPassword()
    {
        return $this->password;
    }
    
}
