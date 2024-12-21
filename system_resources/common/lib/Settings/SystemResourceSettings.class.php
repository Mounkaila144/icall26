<?php

class SystemResourceSettings extends mfSettingsBase {
    
     protected static $instance=null;    
     
     function __construct($site=null)
     {
         parent::__construct(null,null,'frontend',$site);
     } 
      
     function getDefaults()
     {   
         $this->add(array( 
                            'resources'=>array(),
                          ));
        
     }        
     
     
     
     function getResources()
     {
         return new mfArray($this->get('resources'));
     }
     
     function register($name,$component)
     {
         $this->data['resources'][$name]=$component;
         $this->modified=true;
         $this->save();
         return $this;
     }
     
     function unregister($name)
     {
         if (isset( $this->data['resources'][$name]))
         {    
             unset( $this->data['resources'][$name]);
             $this->modified=true;
             $this->save();
         }
         return $this;
     }
    
     function hasResource($name)
     {
         return isset($this->data['resources'][$name]);
     }
     
     function isResourceValidated($name)
     {
         return (boolean)$this->get($name."_validated");
     }
         
     
     function isResourceAvailable($name)
     {
         return (boolean)$this->get($name."_available");
     }
     
     function getResourceVersion($name)
     {
         return $this->get($name."_version");
     }
     
     function setResourceVersion($name,$version)
     {
         $this->set($name."_available",true);
         $this->set($name."_validated",true);
         $this->set($name."_version",$version);
         $this->save();
         return $this;
     }
}
