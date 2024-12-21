<?php


class DomoprimeQuotationForMeetingFormFilter extends mfFormFilterBase {

     protected $user=null,$conditions=null;
    
    function __construct($user) {
        $this->user=$user;
        $this->conditions=new ConditionsQuery(); 
        parent::__construct();
    }
    
    function getUser()
    {
        return $this->user;
    } 
    
    function configure()
    {                          
       $this->setDefaults(array(
           
            'order'=>array(
                            "created_at"=>"desc",                        
            ),            
            'nbitemsbypage'=>"10",
       ));          
       if (!$this->getUser()->hasCredential(array(array('superadmin','admin'))))   
       {                  
          $this->conditions->setWhere(DomoprimeQuotation::getTableField('status')."='ACTIVE'");
       }  
       $this->setClass('DomoprimeQuotation');
       $this->setFields(array());
       $this->setQuery("SELECT {fields} FROM ".DomoprimeQuotation::getTable().  
                       " LEFT JOIN ".DomoprimeQuotation::getOuterForJoin('creator_id').  
                       " WHERE ".DomoprimeQuotation::getTableField('meeting_id')."='{meeting_id}'".
                       $this->conditions->getWhere('AND'). 
                       ";"); 
       // Validators 
       $this->setValidators(array( 
                  
            'order' => new mfValidatorSchema(array(
                                                        "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                    
                                                      //  "name"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                                                       "created_at"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
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
                  "quotation_email_models"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerModelEmailUtils::getModelEmailsForSelect($this->getUser()->getLanguage()),"key"=>true,"required"=>true)),                                          
                       
                           // "lang"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getLanguagesSort($this->getSite()),"key"=>true,"required"=>false)),                            
                          //  "meta_title"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getProductI18nFieldValuesForSelect('meta_title',$this->getSite()),"key"=>true,"required"=>false)),                            
                          //  "reference"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getProductI18nFieldValuesForSelect('reference',$this->getSite()),"key"=>true,"required"=>false)),                            
                          //  "customer_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getCustomerFieldValuesForSelect($this->getSite()),"key"=>true,"required"=>false)),
                            ),array("required"=>false)),                                        
            'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","*"=>"*"),"key"=>true)),                    
        ));              
    }
    

    
    
}

