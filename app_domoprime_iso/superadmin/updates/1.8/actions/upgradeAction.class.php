<?php


class app_domoprime_iso_upgrade_18_Action extends mfModuleUpdate {
 
    function execute()
    {             
       $settings=new DomoprimeIsoSettings(null,$this->getSite()); 
       $settings->set('cumac_engine','IsoEngine')->save();
    }
}

