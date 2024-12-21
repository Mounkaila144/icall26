<?php

class CustomerMeetingFormsSettings extends mfSettingsBase {
    
     protected static $instance=null;    
     
     function __construct($data=null,$site=null)
     {
         parent::__construct($data,null,'frontend',$site);
     } 
      
     function getDefaults()
     {   
         $this->add(array(
                            'fields_feature'=>'NO',
                            'is_schema_build'=>'NO',
                            'filter_columns'=>array(),
                            'display_columns'=>array()
                          ));
        
     }        
      
     function isAvailable()
     {
         return ($this->get('fields_feature')=='YES' && $this->get('is_schema_build')=='YES');
     }
}
