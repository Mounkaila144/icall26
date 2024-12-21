<?php

class SiteSettings extends mfSettingsBase {
    
     protected static $instance=null;    
     
     function __construct($data=null)
     {
         parent::__construct($data,null,'superadmin');
     } 
      
     function getDefaults()
     {   
         $this->add(array(
                             // "root_db_name"=>'ewebsolutb',                              
                          ));
        
     }        
     
}
