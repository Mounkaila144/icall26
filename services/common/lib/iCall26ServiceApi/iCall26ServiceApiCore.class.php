<?php

class old_iCall26ServiceApiCore {
    
    protected $options=array(),$host="",$domain="",$errors=array(),$parameters=array(),$command="",$token="";
    
    function __construct($host,$domain,$options=array()) {  
        $this->domain=$domain;
        $this->host=$host;
        $this->options=$options;              
    }
    
    function call()
    {                   
        $parameters=array();
        $this->response=null;        
        foreach ($this->parameters as $name=>$parameter)
            $parameters[$name]= $parameter;
        if ($this->token)
            $parameters['token']=urlencode($this->token);            
        $ch = curl_init();                         
        curl_setopt($ch, CURLOPT_URL, $this->getHost().$this->getDomain().$this->command);         
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_HEADER, true);   
        curl_setopt($ch,CURLOPT_POST, count($parameters));
        curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($parameters));     
        curl_setopt($ch,CURLOPT_TIMEOUT,60);        
        $content = curl_exec($ch);                 
        $header  = curl_getinfo( $ch );
        curl_close($ch);                    
        if ($content===false)
        {    
            trigger_error(curl_error($ch));
            return false;
        }            
        $header_content = substr($content, 0, $header['header_size']);        
        $this->response = trim(str_replace($header_content, '', $content));    
        $this->parameters=array();
        return true;
    }
        
    function setOption($name,$value)
    {
        $this->options[$name]=$value;
        return $this;
    }  
    
    function getOption($name,$default=null)
    {
      return isset($this->options[$name])?$this->options[$name]:$default;
    }
    
    function send()
    {      
       return $this->call(); 
    }
    
    function login($username,$password)
    {
        $this->session="";         
        $this->setCommand('login',array('username'=>$username,'password'=>$password));
        $this->send();
        $response= json_decode($this->getResponse(),true);
        $this->token=$response['token'];        
    }
    
    function setCommand($command,$parameters=array())
    {
        $this->command=$command;
        $this->parameters=$parameters;
        return $this;
    }
    
    function setParameters($parameters)
    {
        $this->parameters=$parameters;
        return $this;
    }
    
    function getResponse()
    {
        return $this->response;
    }
     
    
    function setToken($token)
    {
        $this->token=$token;
        return $this;
    }
    
    function getToken()
    {
        return $this->token;
    }
    
    function getHost()
    {
        return $this->host;
    }
    
    function getDomain()
    {
        return $this->domain;
    }
   
}