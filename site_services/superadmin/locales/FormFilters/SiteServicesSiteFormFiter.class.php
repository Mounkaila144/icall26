<?php


class SiteServicesSiteFormFiter extends mfFormFilterBase {
   
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
       $this->setClass('SiteServicesSite');
       $this->setFields(array());
       $this->setQuery("SELECT {fields} FROM ".SiteServicesSite::getTable().                                                                  
                       ";"); 
       // Validators 
       $this->setValidators(array( 
                  
            'order' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                    
                            "host"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "db_name"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
                            "db_host"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            //"subject"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),    
                                                       ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(   
                            "host"=>new mfValidatorString(array("required"=>false)),                            
                            "db_name"=>new mfValidatorString(array("required"=>false)),
                            "db_host"=>new mfValidatorString(array("required"=>false)), 
                              "company"=>new mfValidatorString(array("required"=>false)),                                
                            ),array("required"=>false)),                             
            'range' => new mfValidatorSchema(array(   
                          //  "created_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                           // "expired_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                            ),array("required"=>false)),                                                         
            'equal' => new mfValidatorSchema(array(   
                            "is_active"=>new mfValidatorChoice(array("choices"=>array(""=>"","Y"=>__("YES"),"N"=>__("NO")),"key"=>true,"required"=>false)),                
                          "admin_available"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>__("YES"),"NO"=>__("NO")),'key'=>true,"required"=>false)),
                            "frontend_available"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>__("YES"),"NO"=>__("NO")),'key'=>true,"required"=>false)),
                            "available"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>__("YES"),"NO"=>__("NO")),'key'=>true,"required"=>false)),
                            "admin_theme"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ThemesUtils::getListTheme("admin"),'key'=>true,"required"=>false)),
                           // "lang"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getLanguagesSort($this->getSite()),"key"=>true,"required"=>false)),                            
                          //  "meta_title"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getProductI18nFieldValuesForSelect('meta_title',$this->getSite()),"key"=>true,"required"=>false)),                            
                          //  "reference"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getProductI18nFieldValuesForSelect('reference',$this->getSite()),"key"=>true,"required"=>false)),                            
                               "server_id"=>new mfValidatorChoice(array("key"=>true,"choices"=>array(""=>"")+SiteServicesServer::getServersForSelect()->toArray(),"required"=>false)),
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
