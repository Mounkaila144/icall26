<?php

class iCall26ServerServiceApi extends iCall26ServiceApiCore {
    
    
    function getService()
    {
       return 'services/server/admin/';   
    }    
    
    function siteList(){    
        
        return  $this->send('ListSites');         
    }
        
    function ping(){    
        $response=$this->send('Ping');         
        return $response;
    }
    
    function changeAdminSites($hosts,$value){        
        $response  = $this->send("ChangeAdminSites", array('hosts'=>$hosts,'value'=>$value));            
        return $response;
    }
    
   function getState(){    
      
        $response=$this->send('State');         
        return $response;
    }
    
     function getUserStatistics()
    {
        $this->service='services/server/users/statistics/admin/';
        $response  = $this->send('NumberOfSessionsForMonth');       
        
        echo "<pre>"; var_dump($response);
        return $response;     
    }
    
     function getSizes(){    
      
        $response=$this->send('Sizes');         
        return $response;
    }
    
    
}