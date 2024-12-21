<?php

class MutualSettings extends mfSettingsBase {
    
    protected static $instance=null;    

    function __construct($data=null,$site=null)
    {
        parent::__construct($data,null,'frontend',$site);
    } 
      
    function getDefaults()
    {   
        $this->add(array(
                            "nb_days_to_add"=>30,//nombre des jours a ajouter a la date d'aujourd'hui pour la calculation des meetings
                            "nb_meetings_to_process"=>15,
                        ));
    }
}
