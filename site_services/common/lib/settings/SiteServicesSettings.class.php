<?php


class SiteServicesSettings extends mfSettingsBase {
   
    protected static $instance=null;
     
     function __construct($data=null)
     {
         parent::__construct($data,null,'frontend');
     }
     
     
    function getDefaults()
     {   
         $this->add(array(
                            'server_id'=>null,
                            'last_update'=>null,     
                            'private_key'=> file_get_contents(__DIR__."/private.ppk"),
                          ));
        
     }    
     
     function getServerId(){
         return $this->get('server_id');
     }
     
     function setLastUpdate()
     {
         $this->set('last_update',date("Y-m-d H:i:s"));
         $this->save();
         return $this;
     }
     
     function hasLastUpdate()
     {
         return (boolean)$this->get('last_update');         
     }
     
     function getFormattedLastUpdate()
     {         
            return format_date($this->get('last_update'),array('d','q'));       
     }
     
     function getPrivateKey()
     {
         return $this->get('private_key');
     }
     
}
