<?php


class DomoprimeSectorEnergyForProductFormFilter extends mfFormFilterBase {

       
    
    function configure()
    {                          
       $this->setDefaults(array(             
            'order'=>array(
                            "id"=>"asc",                        
            ),            
            'nbitemsbypage'=>"10",
       ));          
       $this->setClass('DomoprimeProductSectorEnergy');
       $this->setFields(array());
       $this->setQuery("SELECT {fields} FROM ".DomoprimeProductSectorEnergy::getTable().                      
                       " INNER JOIN ".DomoprimeProductSectorEnergy::getOuterForJoin('energy_id'). 
                       " INNER JOIN ".DomoprimeProductSectorEnergy::getOuterForJoin('sector_id'). 
                       " LEFT JOIN ".DomoprimeEnergyI18n::getInnerForJoin('energy_id'). " AND ".DomoprimeEnergyI18n::getTableField('lang')."='{lang}'".                                                                               
                       " WHERE ".DomoprimeProductSectorEnergy::getTableField('product_id')."='{product_id}'".
                       ";"); 
       // Validators 
       $this->setValidators(array( 
                  
            'order' => new mfValidatorSchema(array(
                                                        "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                    
                                                     //   "name"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                                                     //   "value"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
                                                       ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(   
                          //  "id"=>new mfValidatorString(array("required"=>false)),                            
                          //  "link"=>new mfValidatorString(array("required"=>false)),                            
                          //  "title"=>new mfValidatorString(array("required"=>false)),                            
                            ),array("required"=>false)),                             
            'range' => new mfValidatorSchema(array(   
                          //  "created_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                           // "expired_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                            ),array("required"=>false)),                                                         
            'equal' => new mfValidatorSchema(array(   
                           // "lang"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getLanguagesSort($this->getSite()),"key"=>true,"required"=>false)),                            
                          //  "meta_title"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getProductI18nFieldValuesForSelect('meta_title',$this->getSite()),"key"=>true,"required"=>false)),                            
                          //  "reference"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getProductI18nFieldValuesForSelect('reference',$this->getSite()),"key"=>true,"required"=>false)),                            
                          //  "customer_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getCustomerFieldValuesForSelect($this->getSite()),"key"=>true,"required"=>false)),
                            ),array("required"=>false)),                              
          //  'lang'=>new LanguagesExistsValidator(array(),'frontend'), 
            'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","*"=>"*"),"key"=>true)),                    
        ));              
    }
    

    
    
}
