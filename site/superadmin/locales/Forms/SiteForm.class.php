<?php

class SiteForm extends mfForm {

    function configure() { 
                
        if (!$this->hasDefaults())
        {    
            $this->setDefaults(array(
                    'site_db_name' =>"site_".mfTools::generateUniqueId(),
                    'site_db_login'=>'root',
                    'site_db_host'=>'localhost'
                ));
        }
        $this->setValidators(array(
            'site_host' => new mfValidatorDomain(), 
            'site_db_name' => new mfValidatorString(),
            'site_admin_theme' => new mfValidatorChoice(array("choices"=>array("default"=>"default")+ThemesUtils::getListTheme("admin"),"key"=>true)),
            'site_frontend_theme' => new mfValidatorChoice(array("choices"=>array("default"=>"default")+ThemesUtils::getListTheme("frontend"),"key"=>true)),
            'site_type' => new mfValidatorChoice(array("choices"=>array("ECOM" =>"ECommerce", "CMS" =>"Content Management System","CUST"=>"Custom"),"key"=>true)),
          //  'site_master' => new mfValidatorChoice(array('required' => false,"choices"=>array(""=>"")+SiteUtils::getListDatabase(),"key"=>true)),
            'site_db_login'=> new mfValidatorString(), //array("required" => false)),
            'site_db_password'=> new mfValidatorString(array('required' => false)),
            'site_db_host'=>new mfValidatorString(), //array("required" => false)),
            'site_admin_theme_base' => new mfValidatorChoice(array("choices"=>array("default"=>"default")+ThemesUtils::getListTheme("admin"),"key"=>true)),
            'site_frontend_theme_base' => new mfValidatorChoice(array("choices"=>array("default"=>"default")+ThemesUtils::getListTheme("frontend"),"key"=>true)),
        ));
    }
}