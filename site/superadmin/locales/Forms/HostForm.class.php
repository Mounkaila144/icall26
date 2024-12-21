<?php

class HostForm extends mfForm {

    function configure() {       
        $this->setValidators(array(
            'site_host' => new mfValidatorDomain(),
            'site_db_name' => new mfValidatorChoice(array("choices"=>SiteUtils::getListDatabase())),
            'site_admin_theme' => new mfValidatorChoice(array("choices"=>array("default"=>"default")+ThemesUtils::getListTheme('admin'),"key"=>true)),
            'site_frontend_theme' => new mfValidatorChoice(array("choices"=>array("default"=>"default")+ThemesUtils::getListTheme('frontend'),"key"=>true)),
            'site_type' => new mfValidatorChoice(array("choices"=>array("ECOM" =>"ECommerce", "CMS" => "Content Management System","CUST"=>"Custom"),"key"=>true)),
            'site_master' => new mfValidatorChoice(array('required' => false,"choices"=>array(""=>"")+SiteUtils::getListDatabase()))
        ));
    }
}