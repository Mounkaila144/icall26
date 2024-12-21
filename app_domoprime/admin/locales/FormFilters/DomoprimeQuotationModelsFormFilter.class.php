<?php


class DomoprimeQuotationModelsFormFilter extends mfFormFilterBase {

    protected $language=null,$objects=array();
    
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
       $this->objects=array('DomoprimeQuotationModelI18n','DomoprimeQuotationModel');
       $this->setDefaults(array(
            'lang'=>$this->getLanguage(),     
            'order'=>array(
                            "id"=>"asc",                        
            ),            
          //  'nbitemsbypage'=>"10",
       ));          
       $this->setClass('DomoprimeQuotationModel');
       $this->setFields(array(
           'value'=>'DomoprimeQuotationModelI18n',
            'polluter_id'=>array(
               'class'=>'PartnerPolluterCompany',
                'name'=>'name',
                'search'=>array('conditions'=>
                   "(".
                   PartnerPolluterCompany::getTableField('name')." COLLATE UTF8_GENERAL_CI LIKE '%%{polluter_id}%%'".                                 
                   ")")
            ),
           )               
               );
       $this->setQuery("SELECT {fields} FROM ".DomoprimeQuotationModel::getTable().  
                       " LEFT JOIN ".DomoprimeQuotationModelI18n::getInnerForJoin('model_id'). " AND ".DomoprimeQuotationModelI18n::getTableField('lang')."='{lang}'".                                                                                                 
                       ";");
       // Validators 
       $this->setValidators(array( 
                  
            'order' => new mfValidatorSchema(array(
                                                        "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                    
                                                        "name"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                                                        "value"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
                                                        "subject"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
                                                        "polluter_id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
                                                       ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(   
                          //  "id"=>new mfValidatorString(array("required"=>false)),                            
                          //  "link"=>new mfValidatorString(array("required"=>false)),                            
                            "polluter_id"=>new mfValidatorString(array("required"=>false)),                            
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
                            //"polluter_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ PartnerPolluterCompany::getPolluters2ForSelect($this->site),"key"=>true,"required"=>false)),
                            ),array("required"=>false)),                              
            'lang'=>new LanguagesExistsValidator(array(),'frontend'), 
          //  'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","*"=>"*"),"key"=>true)),                    
        ));              
    }
    
    
    
}

