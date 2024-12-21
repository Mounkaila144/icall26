<?php

class SiteSuperadmin extends Site {
      
 
    function __construct()
    {         
       return  $this->loadbyName(mfConfig::getSuperAdmin('site'));        
    } 
    
}
