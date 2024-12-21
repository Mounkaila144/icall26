<?php


class MarketingLeadsWpFormsFormFilter extends mfFormFilterBase {

    protected $language=null;
    
    function __construct($language)
    {
        $this->language=$language;     
        parent::__construct();      
    }
    
    function getLanguage()
    {
        return $this->language;
    }
    
    function configure()
    {   
        $this->setDefaults(array(     
            'order'=>array(
                "id"=>"desc",                        
            ),            
            'nbitemsbypage'=>"250",
        ));          
        $this->setClass('MarketingLeadsWpForms');
        $this->setQuery("SELECT * FROM ".MarketingLeadsWpForms::getTable().    
                        " WHERE ".MarketingLeadsWpForms::getTableField("site_id")."='{site_id}'".
                        " AND ".MarketingLeadsWpForms::getTableField("status")."='ACTIVE'".
                        ";"); 
        // Validators 
        $this->setValidators(array( 
            'order' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                    
                            "firstname"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "lastname"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
                            "income"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
                            "number_of_people"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
                            "postcode"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
                            "referrer"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                            
                            "utm_source"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),  
                            "utm_medium"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),  
                            "utm_campaign"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
                        ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(   
                            "id"=>new mfValidatorString(array("required"=>false)),                            
                            "firstname"=>new mfValidatorString(array("required"=>false)),                            
                            "lastname"=>new mfValidatorString(array("required"=>false)),                            
                            "income"=>new mfValidatorString(array("required"=>false)),                            
                            "number_of_people"=>new mfValidatorString(array("required"=>false)),                              
                            "phone"=>new mfValidatorString(array("required"=>false)),                            
                            "email"=>new mfValidatorString(array("required"=>false)),                            
                            "address"=>new mfValidatorString(array("required"=>false)),                            
                            "postcode"=>new mfValidatorString(array("required"=>false)),                            
                            "city"=>new mfValidatorString(array("required"=>false)),                            
                            "country"=>new mfValidatorString(array("required"=>false)),     
                  "referrer"=>new mfValidatorString(array("required"=>false)),                              
                            "utm_source"=>new mfValidatorString(array("required"=>false)),                            
                            "utm_medium"=>new mfValidatorString(array("required"=>false)),                            
                            "utm_campaign"=>new mfValidatorString(array("required"=>false)),    
                        ),array("required"=>false)),                             
            'range' => new mfValidatorSchema(array(   
                            //"created_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                            //"expired_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                        ),array("required"=>false)),                                                         
            'equal' => new mfValidatorSchema(array(   
                            "owner"=>new mfValidatorChoice(array("choices"=>array(""=>"")+MarketingLeadsWpFormsUtils::getOwnerWithI18n()->toArray(),"key"=>true,"required"=>false)),                            
                            "energy"=>new mfValidatorChoice(array("choices"=>array(""=>"")+MarketingLeadsWpFormsUtils::getEnergyWithI18n()->toArray(),"key"=>true,"required"=>false)),
                        ),array("required"=>false)),                 
            'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","250"=>"250"),"key"=>true)),                    
        ));              
    }
}

