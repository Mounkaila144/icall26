<?php

class iCall26ServerWebServiceApiCore {
    
    protected $options=array(),$host="",$domain="",$errors=array(),$parameters=array(),$command="",$site=null; 
    
    function __construct($host,$domain,$options=array(),$site=null) {  
        $this->domain=$domain;
        $this->host=$host;
        $this->options=$options; 
        $this->site=$site?$site: mfContext::getInstance()->getSite()->getSite();       
    }
    
    function getSite()
    {
        return $this->site;
    }
    
    protected function configure()
    {
        
    }
    
    function call()
    {                   
        $parameters=array();
        $this->response=null;       
        $this->configure();
        foreach ($this->parameters as $name=>$parameter)
            $parameters[$name]= $parameter;           
        $ch = curl_init();                         
        curl_setopt($ch, CURLOPT_URL, $this->getHost().$this->getDomain().$this->command);         
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_HEADER, true);   
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POSTREDIR, 3);
        curl_setopt($ch,CURLOPT_POST, count($parameters));
        curl_setopt($ch, CURLOPT_REFERER, $this->getSite()->getHost());
        curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($parameters));     
        curl_setopt($ch,CURLOPT_TIMEOUT,60);        
        $content = curl_exec($ch);                 
        $header  = curl_getinfo( $ch );
        curl_close($ch);     
     //   var_dump($content); die(__METHOD__);
        
        if (isset($header['http_code']) && $header['http_code']=='401')        
            return false;        
        if ($content===false)
        {    
            trigger_error(curl_error($ch));
            return false;
        }            
        $header_content = substr($content, 0, $header['header_size']);            
        $this->response = new mfJson(trim(str_replace($header_content, '', $content)));   
        $this->parameters=new mfArray();
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
    
   
    
    function setCommand($command,mfArray $parameters=null)
    {
        $this->command=$command;
        if ($parameters)
           $this->parameters=$parameters;        
        return $this;
    }
    
    function setParameters(mfArray $parameters)
    {
        $this->parameters=$parameters;
        return $this;
    }
    
    function setParameter($name,$parameter)
    {
        $this->parameters[$name]=$parameter;
        return $this;
    }
    
    function hasResponse()
    {
        return (boolean)$this->response;
    }
    
    function getResponse()
    {        
        return $this->response;
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