<?php


class DocumentForPolluterFormFilter extends mfFormFilterBase{
   
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
           'lang'=>$this->getLanguage(),     
            'order'=>array(
                            "id"=>"asc",                        
            ),            
            'nbitemsbypage'=>"*",
       ));          
       $this->setClass('PartnerPolluterDocument');
       $this->setFields(array());
       $this->setQuery("SELECT {fields} FROM ". CustomerMeetingFormDocument::getTable(). 
                       " LEFT JOIN ".PartnerPolluterDocument::getInnerForJoin('document_id')." AND polluter_id='{polluter_id}'".
                       " LEFT JOIN ".PartnerPolluterDocument::getOuterForJoin('model_id').                                                                  
                       " LEFT JOIN ".PartnerPolluterModelI18n::getInnerForJoin('model_id'). " AND ".PartnerPolluterModelI18n::getTableField('lang')."='{lang}'".                                                                             
                       ";"); 
       // Validators 
       $this->setValidators(array( 
                  
            'order' => new mfValidatorSchema(array(
                         //   "name"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                                                                         
                           ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(   
                          //  "id"=>new mfValidatorString(array("required"=>false)),
                        //  "name"=>new mfValidatorString(array("required"=>false)),
                        //  "city"=>new mfValidatorString(array("required"=>false)),
                        //  "phone"=>new mfValidatorString(array("required"=>false)),
                        //  "postcode"=>new mfValidatorString(array("required"=>false)),
                            ),array("required"=>false)),                             
            'range' => new mfValidatorSchema(array(   
                          //  "created_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                           // "expired_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                            ),array("required"=>false)),                                                         
            'equal' => new mfValidatorSchema(array(   
                           // "lang"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getLanguagesSort($this->getSite()),"key"=>true,"required"=>false)),                            
                            ),array("required"=>false)),        
            'lang'=>new LanguagesExistsValidator(array(),'frontend'), 
            'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","*"=>"*"),"key"=>true)),                    
        ));              
    }
    
}
