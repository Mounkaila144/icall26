<?php

class SiteServicesServerFormFilter extends mfFormFilterBase {
    
     protected $selection=null;
    
    function __construct($selection,$defaults = array()) {        
        $this->selection=$selection;              
        parent::__construct($defaults);
    }
    
     function getDefaultValues()
     {
         $values= new mfArray(array(           
            'order'=>array(
                            "host"=>"asc",                        
            ),                            
            'nbitemsbypage'=>"50",
       ));
          if ($this->selection)
             $values['selected']=$this->selection;
         return $values;
     }
     
     function configure()
    {                         
       if (!$this->hasDefaults())
            $this->addDefaults($this->getDefaultValues()->toArray());          
       $this->setClass('SiteServicesServer');
       $this->setFields(array());
       $this->setQuery("SELECT {fields} FROM ".SiteServicesServer::getTable().                                                                  
                       ";"); 
       // Validators 
       $this->setValidators(array( 
                  
            'order' => new mfValidatorSchema(array(
                                                        "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                    
                                                        "host"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                                                        "name"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
                                                        "ip"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
                //    "subject"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),    
                                                       ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(   
                            "host"=>new mfValidatorString(array("required"=>false)),                            
                            "name"=>new mfValidatorString(array("required"=>false)),
                            "ip"=>new mfValidatorString(array("required"=>false)), 
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
           
             "selected"=>new mfValidatorSchemaForEach(new mfValidatorInteger(),count($this->getDefault('selected')),array("required"=>false)),
           'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","*"=>"*"),"key"=>true)),                    
        ));              
    }
    
    function getSelected()
    {
        return new mfArray($this['selected']->getValue());
    }
    
}
