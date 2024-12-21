<?php


class CustomerMeetingDocumentFormFormFilter extends mfFormFilterBase {

    
   
    
    function configure()
    {                        
       $this->setDefaults(array(            
            'order'=>array(
                            "id"=>"asc",                        
            ),            
            'nbitemsbypage'=>"50",
       ));          
       $this->setClass('CustomerMeetingFormDocument');
       $this->setFields(array());
       $this->setQuery("SELECT {fields} FROM ".CustomerMeetingFormDocument::getTable(). 
                       " INNER JOIN ".CustomerMeetingFormDocument::getOuterForJoin('model_id').
                       " LEFT JOIN ".ProductModelI18n::getInnerForJoin('model_id')." AND lang='{lang}'".   
                       " LEFT JOIN ".DomoprimeCustomerMeetingFormDocumentClass::getInnerForJoin('form_document_id').
                       " LEFT JOIN ".DomoprimeCustomerMeetingFormDocumentClass::getOuterForJoin('class_id').
                       " LEFT JOIN ".DomoprimeClassI18n::getInnerForJoin('class_id')." AND ".DomoprimeClassI18n::getTableField('lang')."='{lang}'".
                       ";"); 
       // Validators 
       $this->setValidators(array( 
                  
            'order' => new mfValidatorSchema(array(
                                                        "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                    
                                                      //  "name"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                                                      //  "value"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
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
            'nbitemsbypage'=>new mfValidatorChoice(array("choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","*"=>"*"),"key"=>true)),                    
        ));              
    }
    
    
}

