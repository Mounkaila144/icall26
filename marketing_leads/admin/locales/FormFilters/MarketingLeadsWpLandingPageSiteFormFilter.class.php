<?php


class MarketingLeadsWpLandingPageSiteFormFilter extends mfFormFilterBase {
    
    function configure()
    {   
        $this->setDefaults(array(    
            'order'=>array(
                "id"=>"asc",                        
            ),            
            'nbitemsbypage'=>"50",
        ));          
        $this->setClass('MarketingLeadsWpLandingPageSite');
        $this->setQuery("SELECT * FROM ".MarketingLeadsWpLandingPageSite::getTable().
                        ";"); 
        // Validators 
        $this->setValidators(array( 
                  
            'order' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                    
                            "host_site"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "host_db"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
                            "name_db"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
                            "campaign"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
                        ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(   
                            "id"=>new mfValidatorString(array("required"=>false)),                            
                            "host_site"=>new mfValidatorString(array("required"=>false)),                            
                            "host_db"=>new mfValidatorString(array("required"=>false)),                            
                            "name_db"=>new mfValidatorString(array("required"=>false)),                            
                            "user_db"=>new mfValidatorString(array("required"=>false)),                            
//                            "campaign"=>new mfValidatorString(array("required"=>false)),                            
                        ),array("required"=>false)),                             
            'range' => new mfValidatorSchema(array(   
                            // "created_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                            // "expired_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                        ),array("required"=>false)),                                                         
            'equal' => new mfValidatorSchema(array(
                            "campaign"=>new mfValidatorChoice(array("choices"=>array(""=>"")+MarketingLeadsWpLandingPageSite::getCampaignsForSelect()->toArray(),"key"=>true,"required"=>false)),
                            //  "reference"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getProductI18nFieldValuesForSelect('reference',$this->getSite()),"key"=>true,"required"=>false)),                            
                            //  "customer_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getCustomerFieldValuesForSelect($this->getSite()),"key"=>true,"required"=>false)),
                        ),array("required"=>false)),                    
            'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","*"=>"*"),"key"=>true)),                    
        ));              
    }
}

