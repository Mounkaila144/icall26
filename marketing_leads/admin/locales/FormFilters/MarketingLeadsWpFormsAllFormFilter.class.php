<?php


class MarketingLeadsWpFormsAllFormFilter extends mfFormFilterBase {
    
    protected $site=null,$conditions=null;
    
    function __construct($user,$site=null)
    {                
       $this->site=$site; 
       $this->user=$user;  
       $this->conditions=new ConditionsQuery();
       parent::__construct();      
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
        $this->setFields(array('campaign'=>'MarketingLeadsWpLandingPageSite'));
        $this->setQuery("SELECT {fields} FROM ".MarketingLeadsWpForms::getTable().    
                        " INNER JOIN ".MarketingLeadsWpForms::getOuterForJoin("site_id").
                        " LEFT JOIN ".MarketingLeadsWpForms::getOuterForJoin("state_id").
                        " LEFT JOIN ". MarketingLeadsWpFormsStatusI18n::getInnerForJoin("status_id").
                        " WHERE ".MarketingLeadsWpForms::getTableField("status")."='ACTIVE'".
                        ";"); 
        // Validators 
        $this->setValidators(array( 
            //'id_wp','site_id','firstname','lastname','income','number_of_people','owner','energy',
            //'phone','email','address','postcode','city','country'
            //'duplicate_wpf','zone','is_duplicate','phone_status',
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
//                            "campaign"=>new mfValidatorString(array("required"=>false)),                            
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
                            "zone"=>new mfValidatorString(array("required"=>false)),  
                            "referrer"=>new mfValidatorString(array("required"=>false)),                              
                            "utm_source"=>new mfValidatorString(array("required"=>false)),                            
                            "utm_medium"=>new mfValidatorString(array("required"=>false)),                            
                            "utm_campaign"=>new mfValidatorString(array("required"=>false)),        
                        ),array("required"=>false)),                             
            'range' => new mfValidatorSchema(array(   
                            "created_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                            //"expired_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                        ),array("required"=>false)),  
            'in'=>new mfValidatorSchema(array( 
                            "campaign"=>new mfValidatorChoice(array("choices"=>array(""=>"")+MarketingLeadsWpLandingPageSite::getCampaignsForSelect()->toArray(),'multiple'=>true,"key"=>true,"required"=>false)),                          
                            "site_id"=>new mfValidatorChoice(array("choices"=>MarketingLeadsWpLandingPageSite::getSitesForSelect()->toArray(),'multiple'=>true,"key"=>true,"required"=>false)),                          
                            "state"=>new mfValidatorChoice(array("choices"=>array(""=>"","NEW"=>__("NEW"),"NOT EXPORTED"=>__("NOT EXPORTED"),"EXPORTED"=>__("EXPORTED")),'multiple'=>true,"key"=>true,"required"=>false)),                          
                            "state_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+MarketingLeadsWpFormsStatus::getStatusWithI18nForSelect()->toArray(),'multiple'=>true,"key"=>true,"required"=>false)),
                        ),array("required"=>false)), 
            'equal' => new mfValidatorSchema(array(   
                            "owner"=>new mfValidatorChoice(array("choices"=>array(""=>"")+MarketingLeadsWpFormsUtils::getOwnerWithI18n()->toArray(),"key"=>true,"required"=>false)),                            
                            "energy"=>new mfValidatorChoice(array("choices"=>array(""=>"")+MarketingLeadsWpFormsUtils::getEnergyWithI18n()->toArray(),"key"=>true,"required"=>false)),
                            "duplicate_wpf"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>__("YES"),"NO"=>__("NO")),"key"=>true,"required"=>false)),
                            "is_duplicate"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>__("YES"),"NO"=>__("NO")),"key"=>true,"required"=>false)),
                            "phone_status"=>new mfValidatorChoice(array("choices"=>array(""=>"")+MarketingLeadsWpFormsUtils::getPhoneStatus()->toArray(),"key"=>true,"required"=>false)),
                            "zone"=>new mfValidatorChoice(array("choices"=>array(""=>"")+MarketingLeadsWpFormsUtils::getZones()->toArray(),"key"=>true,"required"=>false)),
                            "campaign"=>new mfValidatorChoice(array("choices"=>array(""=>"")+MarketingLeadsWpLandingPageSite::getCampaignsForSelect()->toArray(),"key"=>true,"required"=>false)),
//                            "state"=>new mfValidatorChoice(array("choices"=>array(""=>"","NEW"=>__("NEW"),"NOT EXPORTED"=>__("NOT EXPORTED"),"EXPORTED"=>__("EXPORTED")),"key"=>true,"required"=>false)),
                            "state_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+MarketingLeadsWpFormsStatus::getStatusWithI18nForSelect()->toArray(),"key"=>true,"required"=>false)),
                        ),array("required"=>false)),                 
            'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","500"=>"500","250"=>"250"),"key"=>true)),                    
        ));              
    }
    
    function getConditions()
    {               
        return $this->conditions;
    }
    
    function _extractParameterForUrl($name) 
    {
        if ($name=='range')
        {
            $values=$this['range']->getValue();
            if (isset($values['created_at']))
            {
                foreach ($values['created_at'] as $name=>$value)               
                    $values['created_at'][$name]=format_date($value,"a");                
            }    
            return $values;
        }    
        return parent::_extractParameterForUrl($name);
    }
}

