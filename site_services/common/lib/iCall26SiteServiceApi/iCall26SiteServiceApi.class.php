<?php

class iCall26SiteServiceApi extends iCall26ServiceApiCore {
    
   
    function getService()
    {
       return 'services/sites/admin/';   
    }    
    
    function siteList(){    
        return  $this->send('ListSites');         
    }
    
    function ping(){    
        $response=$this->send('Ping');         
        return $response;
    }
    
    function changeAdmin($host,$value){      
        $response=$this->send('ChangeAdmin',array('host'=>$host,'value'=>$value));        
        return $response;
    }
    
    
    function changeFrontend($host,$value){     
        $response=$this->send('ChangeFrontend',array('host'=>$host,'value'=>$value)); 
        return $response;
    }
    
    function changeGlobal($host,$value){        
        $response=$this->send('ChangeGlobal',array('host'=>$host,'value'=>$value));  
        return $response;
    }
    
   /* function siteArchive($host){      
        $response=$this->send('SiteArchive',array('host'=>$host));
        return $response;
    }      */  
    
}
