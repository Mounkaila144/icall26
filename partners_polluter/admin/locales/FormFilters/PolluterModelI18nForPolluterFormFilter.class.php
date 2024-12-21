<?php


class PolluterModelI18nForPolluterFormFilter extends mfFormFilterBase{
   
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
       $this->setClass('PartnerPolluterModelI18n');
       $this->setFields(array(
           'document'=>array('class'=>'PartnerPolluterDocument','name'=>'id')
       ));
       $this->setQuery("SELECT {fields},".PartnerPolluterDocument::getTableField('id')." as document FROM ". PartnerPolluterModel::getTable(). 
                       " LEFT JOIN ".PartnerPolluterModelI18n::getInnerForJoin('model_id'). " AND ".PartnerPolluterModelI18n::getTableField('lang')."='{lang}'".                                                        
                       " LEFT JOIN ".PartnerPolluterDocument::getInnerForJoin('model_id')." AND ".PartnerPolluterDocument::getTableField('polluter_id')."='{polluter_id}'".   
                       " WHERE ".PartnerPolluterModel::getTableField('polluter_id')."='{polluter_id}'".
                       " GROUP BY ".PartnerPolluterModel::getTableField('id'). 
                       ";"); 
       // Validators 
       $this->setValidators(array( 
                  
            'order' => new mfValidatorSchema(array(
                            "name"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                                                                         
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
                            "document"=>new mfValidatorChoice(array("choices"=>array(""=>"","IS_NULL"=>__("Not used"),"IS_NOT_NULL"=>__("Used")),"key"=>true,"required"=>false)),                            
                            ),array("required"=>false)),        
            'lang'=>new LanguagesExistsValidator(array(),'frontend'), 
            'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","*"=>"*"),"key"=>true)),                    
        ));              
    }
    
}
