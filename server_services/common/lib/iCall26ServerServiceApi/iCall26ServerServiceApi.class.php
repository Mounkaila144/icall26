<?php

class iCall26ServerServiceApi extends iCall26ServiceApiCore {
    
    function __construct(\SiteServicesServer $server, $options = array()) {
        parent::__construct($server, $options);
        $this->setServerService();  
    }
           
    function setServerService()
    {
        $this->service='services/server/admin/';
        return $this;
    }
    
    function setService($service)
    {
        $this->service=$service;
        return $this;
    }
   
    function getService()
    {
       return   $this->service; //'services/server/admin/';   
    }    
    
    function siteList(){    
        $this->setServerService();
        return  $this->send('ListSites');         
    }
        
    function ping(){    
         $this->setServerService();
        $response=$this->send('Ping');         
        return $response;
    }
    
    function changeAdminSites($hosts,$value){        
         $this->setServerService();
        $response  = $this->send("ChangeAdminSites", array('hosts'=>$hosts,'value'=>$value));            
        return $response;
    }
    
    function exists($host){    
         $this->setServerService();
        $response=$this->send('Exists',array('host'=>$host));                
        return $response->getValue('status')=='OK';
    }
    
    function databaseExists($name){    
         $this->setServerService();
        $response=$this->send('DatabaseExists',array('name'=>$name));                
        return $response->getValue('status')=='OK';
    }
    
    
      function createServer($values)
    {
        $this->setServerService();
        $response=$this->send('CreateServer',$values);      
        
        return $response;
    }
    
    
    function getSizes(){    
      
        $response=$this->send('Sizes');         
        return $response;
    }
    
    function getUserStatistics()
    {
        $this->service='services/server/users/statistics/admin/';
        $response  = $this->send('NumberOfSessionsForMonth');       
      //  echo "<pre>"; var_dump($response);
        return $response;  
        
        
    }
        
  /*  function create($host,$parameters=array()){    
        $parameters['host']=$host;
        $response=$this->send('CreateSite',$parameters);         
        if ($this->hasErrors())
            return false;        
        return $response->getValue('status')=='OK';
    }*/

}
