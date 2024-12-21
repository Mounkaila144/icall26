<?php

class iCall26ServerServicesApi  {
    
    function getService()
    {
       return 'services/server/master/admin/';   
    }    
    
    
    protected $options=array(),$errors=array(),$parameters=array(),$command="",$host="";    
     
    function __construct($options=array()){  
        $this->options=$options;
        $settings=new ServerServicesSettings();
        $this->host=$settings->get('master_host');       
    }
    
         
    
    function call()
    {        
        $parameters=array();
        $this->response=null;        
        foreach ($this->parameters as $name=>$parameter)
            $parameters[$name]= $parameter;              
        $ch = curl_init();               
      //  echo "Command=".$this->getServer()->get('host')."/superadmin/".$service.$this->getCommand();
     //   echo "Command=".$this->getHost()."/superadmin/".$this->getService().$this->getCommand(); var_dump($parameters);
        curl_setopt($ch, CURLOPT_URL, $this->getHost()."/superadmin/".$this->getService().$this->getCommand());   
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_HEADER, true);   
        curl_setopt($ch,CURLOPT_POST, count($parameters));
        curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($parameters));     
        curl_setopt($ch,CURLOPT_TIMEOUT,25);        
        $content = curl_exec($ch);              
        $header  = curl_getinfo( $ch );          
        curl_close($ch);     
        //   if ($this->getCommand()=='CreateSite')  
      //  var_dump($content);
     //  var_dump($this->getServer()->get('host'));
        if($content===false)
        {    
            trigger_error(curl_error($ch));
            return false;
        }           
        // gestion des erreurs         
        $header_content = substr($content, 0, $header['header_size']);           
        $this->content = trim(str_replace($header_content, '', $content));         
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
        $json = new mfJson($this->content);          
        if ($json->isEmpty())
            $this->errors=__('invalid response empty');
        elseif (is_string($json->decode()) || !$json->isJson())        
            $this->errors=__('invalid response');
        else
        {    
            $this->response=$json->toArray();
            if($this->response['status']=='error')
                $this->errors=$this->response['errors'];
        }
        return $this->getResponse();                
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
         
    function hasErrors()
    {
        return !empty($this->errors);
    }
    
    function getErrors()
    {
        return $this->errors;
    }
    
    
    function getCommand()
    {
        return $this->command;
    }
    
    function getHost()
    {
        return $this->host;
    }
    
    function getContent()
    {
        return $this->content;
    }   
    
     function ping(){    
        $response=$this->send('Ping');      
        return $response;
    }
    
    function createSite(Site $site)
    {
        $response=$this->send('CreateSite',$site->toArray(array()));      
        
        return $response;
    }
    
  
}
