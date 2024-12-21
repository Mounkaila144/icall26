<?php


class DomoprimePolluterClassPricingFormFilter extends mfFormFilterBase{
   
    
    
    function configure()
    {                    
       $this->setDefaults(array(            
            'order'=>array(
                            "id"=>"asc",                        
            ),            
            'nbitemsbypage'=>"10",
       ));          
       $this->setClass('DomoprimePolluterClassPricing');
       $this->setFields(array());
       $this->setQuery("SELECT {fields} FROM ". DomoprimePolluterClassPricing::getTable().  
                       " INNER JOIN ".DomoprimePolluterClassPricing::getOuterForJoin('class_id'). 
                       " INNER JOIN ".DomoprimeClassI18n::getInnerForJoin('class_id').
                       " WHERE ".DomoprimePolluterClassPricing::getTableField('polluter_id')."='{polluter_id}'".
                            " AND ".DomoprimeClassI18n::getTableField('lang')."='{lang}'".
                       ";"); 
       // Validators 
       $this->setValidators(array( 
                  
            'order' => new mfValidatorSchema(array(
                       //     "name"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                                                                         
                           ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(   
                          //  "id"=>new mfValidatorString(array("required"=>false)),
                       //   "name"=>new mfValidatorString(array("required"=>false)),
                       //   "city"=>new mfValidatorString(array("required"=>false)),
                       //   "phone"=>new mfValidatorString(array("required"=>false)),
                       //   "postcode"=>new mfValidatorString(array("required"=>false)),
                            ),array("required"=>false)),                             
            'range' => new mfValidatorSchema(array(   
                          //  "created_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                           // "expired_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                            ),array("required"=>false)),                                                         
            'equal' => new mfValidatorSchema(array(   
                           // "lang"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getLanguagesSort($this->getSite()),"key"=>true,"required"=>false)),                            
                            ),array("required"=>false)),                                        
            'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","*"=>"*"),"key"=>true)),                    
        ));              
    }
    
}
