<?php

class LogsSettings extends mfSettingsBase {
    
    protected static $instance=null;

    function __construct($data=null)
    {
        parent::__construct($data,'superadmin');
    } 
      
    function getDefaults()
    {   
        $this->add(array(
                            "nb_days"=>10,
                    ));

    }       
}
