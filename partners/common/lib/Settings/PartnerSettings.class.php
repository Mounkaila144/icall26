<?php

class PartnerSettings extends mfSettingsBase {
    
     protected static $instance=null;    
     
     function __construct($data=null,$site=null)
     {
         parent::__construct($data,null,'frontend',$site);
     } 
      
     function getDefaults()
     {   
         $this->add(array(
                             
                             "partner_group_id"=>null,                              
                              
                          ));
        
     }        
     
     
     
      
}
