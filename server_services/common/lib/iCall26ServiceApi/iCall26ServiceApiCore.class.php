<?php

class iCall26ServiceApiCore {
    
    const key="site_services_";
       
    protected $options=array(),$errors=array(),$parameters=array(),$command="",$server="";    
    static protected $token=array();
            
    function __construct(SiteServicesServer $server,$options=array()){  
        $this->options=$options;
        $this->server=$server;
        self::$token=new mfArray();
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
        $service=$this->getCommand()=='Login'?"services/server/admin/":$this->getService();
      // echo "Command=".$this->getServer()->get('host')."/superadmin/".$service.$this->getCommand(); //var_dump($parameters);
        curl_setopt($ch, CURLOPT_URL, $this->getServer()->get('host')."/superadmin/".$service.$this->getCommand());   
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_HEADER, true);   
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POSTREDIR, 3);
        curl_setopt($ch,CURLOPT_POST, count($parameters));
        curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($parameters));     
        curl_setopt($ch,CURLOPT_TIMEOUT,60);        
        $content = curl_exec($ch);              
        $header  = curl_getinfo( $ch );          
        curl_close($ch);     
       //    if ($this->getCommand()=='Sizes')  
     //  echo "<pre>"; var_dump($content); //die(__METHOD__);
     //  var_dump($this->getServer()->get('host'));
        if($content===false || $header['http_code'] != '200')
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
        if (!$this->call())
            $this->errors=__('bad response');
        else
        {    
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
        }
        return $this->getResponse();                
    }
    
    function login($username,$password)
    {              
         if ($this->getToken())
              return $this;   // already logged
        $response= $this->send('Login',array('username'=>$username,'password'=>$password));                          
        $this->setToken($response['token']);
        return $this;
    }       
    
    function signin()
    {
          if ($this->getToken())
              return $this;   // already logged
           $response= $this->send('Login',array('username'=>$this->getServer()->get('login_service'),
                                                'password'=>$this->getServer()->getDecryptedPassword()));   // $server->getDecryptedPassword()                       
        $this->setToken($response['token']);
        return $this;
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
        if ($this->getServer()->isNotLoaded())
        {    
             self::$token[""]=$token;  
             return $this;
        }
        self::$token[$this->getServer()->get('id')]=$token;       
        return $this;
    }
    
    function getToken()
    {
        if ($this->getServer()->isNotLoaded())
            return self::$token[""];
        return self::$token[$this->getServer()->get('id')];
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
    
    function getServer()
    {
        return $this->server;
    }
    
    function getContent()
    {
        return $this->content;
    }
}
