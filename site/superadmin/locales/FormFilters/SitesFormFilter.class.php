<?php

class SitesFormFilter extends mfFormFilterBase {
 
    function configure()
    {
        $this->setDefaults(array(
            'order'=>array(
                            "site_id"=>"asc",
            ),
            'search'=>array(
                "site_available"=>"YES",
                "site_admin_available"=>"YES",
                         
            ),
            'nbitemsbypage'=>"*",
       ));
       // Base Query
       $this->setQuery("SELECT {fields} FROM ".Site::getTable().";");
        $this->setFields(array(                               
                                'site_company'=>array(
                                            'class'=>'Site',
                                            'search'=>array('conditions'=>                                               
                                                 Site::getTableField('site_company')." COLLATE UTF8_GENERAL_CI LIKE '%%{site_company}%%' "
                                                )
                                ),
            ));
       // Validators 
       $this->setValidators(array(
            'order' => new mfValidatorSchema(array(
                            "site_id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "site_host"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "site_db_name"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "site_admin_theme"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "site_frontend_theme"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "site_type"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                           ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(   
                              "site_id"=>new mfValidatorInteger(array("required"=>false)),   
                              "site_host"=>new mfValidatorString(array("required"=>false)),   
                              "site_company"=>new mfValidatorString(array("required"=>false)), 
                              "site_db_name"=>new mfValidatorString(array("required"=>false)), 
                              "site_admin_available"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>"YES","NO"=>"NO"),"required"=>false)),
                              "site_frontend_available"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>"YES","NO"=>"NO"),"required"=>false)),
                              "site_available"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>"YES","NO"=>"NO"),"required"=>false)),
                           ),array("required"=>false)),
            'equal' => new mfValidatorSchema(array(                                                          
                             "site_company"=>new mfValidatorChoice(array("key"=>true,"choices"=>array(""=>"")+SitesAdmin::getCompaniesForSelect(),"required"=>false)),
                           ),array("required"=>false)),
           'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>5,"10"=>10,"20"=>20,"50"=>50,"100"=>100,"500"=>500,"*"=>"*"))),         
        ));
    }
    
 
}

