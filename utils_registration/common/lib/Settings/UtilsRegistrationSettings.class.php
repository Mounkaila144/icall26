<?php

class UtilsRegistrationSettings extends mfSettingsBase {
    
     protected static $instance=null;
     protected $default_attribution=null;    
     
     function __construct($data=null,$site=null)
     {
         parent::__construct($data,null,'frontend',$site);
     } 
      
     function getDefaults()
     {   $day=new Day();
         $this->add(array(
                           'default_registration' =>null,
                           
             
                          ));
        
     }    
     
    
     
}
