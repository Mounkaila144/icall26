<?php

class UserValidationSettings extends mfSettingsBase {
    
     protected static $instance=null;       
     
     function __construct($data=null,$site=null)
     {
         parent::__construct($data,null,'admin',$site);
     } 
      
     function getDefaults()
     {   
         $this->add(array(
                              "email"=>"",                              
                          ));
        
     }               
     
        function hasEmail()
     {
         return  (boolean)$this->get('email');
     }
     
          
}
