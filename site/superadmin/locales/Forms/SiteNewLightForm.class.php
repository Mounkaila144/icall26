<?php

class SiteNewLightForm extends mfForm {

    protected $host=null;
    
    function configure() {  
        $this->setDefault('site_admin_theme','theme_base');
        $this->setValidators(array(
            'name' => new mfValidatorName(array('min_length'=>6,'max_length'=>20)),
            'site_admin_theme' => new mfValidatorChoice(array("choices"=>array("default"=>"default")+ThemesUtils::getListTheme("admin"),"key"=>true)),
        ));
    }
    
   
    
    function getHostForSite()
    {
        return $this['name']->getValue().".".str_replace("www.","",mfConfig::getSuperAdmin('host'));
    }
    
    
}