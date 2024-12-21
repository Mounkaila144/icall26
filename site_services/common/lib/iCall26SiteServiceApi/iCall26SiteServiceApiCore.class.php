<?php

abstract class iCall26SiteServiceApiCore {
    
    const key="site_services_";
       
    protected $options=array(),$errors=array(),$parameters=array(),$command="",$token="",$server="";
    
    abstract  function getService();
    
    function __construct(SiteServicesServer $server,$options=array()){  
        $this->options=$options;
        $this->server=$server;
    }
    
    static function getKey()
    {
        return md5(self::key);
    }
    
    static function getSession($session)
    {
        return str_replace(self::getKey(),"",$session);
    }        
    
    function call()
    {        
        $parameters=array();
        $this->response=null;        
        foreach ($this->parameters as $name=>$parameter)
            $parameters[$name]= $parameter;
        if ($this->getToken())
            $parameters['token']=urlencode($this->getToken());            
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $this->getServer()->get('host')."/superadmin/".$this->getService().$this->getCommand());   
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_HEADER, true);   
        curl_setopt($ch,CURLOPT_POST, count($parameters));
        curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($parameters));     
        curl_setopt($ch,CURLOPT_TIMEOUT,25);        
        $content = curl_exec($ch);              
        $header  = curl_getinfo( $ch );
        curl_close($ch);          
        if($content===false)
        {    
            if($http_status < 200 || $http_status > 206)
            {
               $this->errors[]= $http_status;
            }
            trigger_error(curl_error($ch));
            $this->errors[]=curl_error($ch);          
            return false;
        }           
        // gestion des erreurs
     //   var_dump($content);
        
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
    
    function send($command,$parameters=array())
    {                 
        $this->setCommand($command,$parameters); 
        $this->call();        
                
        $this->response=new mfArray(json_decode($this->response,true));                
        return $this->getResponse();                
    }
    
    function login($username,$password)
    {
        $response= $this->send('Login',array('username'=>$username,'password'=>$password));
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
    
    function hasErrors()
    {
        return (boolean)$this->errors;
    }
    
    function getErrors()
    {
        return $this->errors;
    }
    
    
    function getCommand()
    {
        return $this->command;
    }
    
    function getServer()
    {
        return $this->server;
    }
}
