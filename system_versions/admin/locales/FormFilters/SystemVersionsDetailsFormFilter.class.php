<?php

class SystemVersionsDetailsFormFilter extends mfFormFilterBase {      
    
    function configure()
    {                   
       
       $this->setDefaults(array(          
            'order'=>array(
                "id"=>"asc",                        
            ),            
            'nbitemsbypage'=>"10",
       ));          
       $this->setClass('SystemVersionsFileBase');
       $this->setFields(array());
       $this->setQuery("SELECT {fields} FROM ".SystemVersionsFileBase::getTable().
                       " INNER JOIN ".ModuleManager::getTable()." ON ".ModuleManager::getTableField("name")."=".SystemVersionsFile::getTableField("module").
                       " WHERE ".ModuleManager::getTableField("status")."='installed'".
                       " AND ".SystemVersionsFile::getTableField("version")."='{version}'".
                       ";"); 
       // Validators 
       $this->setValidators(array( 
                  
            'order' => new mfValidatorSchema(array(
                        "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                    
                        //    "name"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                        //    "value"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
                        ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(                      
                        //  "link"=>new mfValidatorString(array("required"=>false)),                            
                        //  "title"=>new mfValidatorString(array("required"=>false)),                            
                        ),array("required"=>false)),                             
            'range' => new mfValidatorSchema(array(   
                        // "created_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                        // "expired_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                        ),array("required"=>false)),                                                         
            'equal' => new mfValidatorSchema(array(   
                        "module"=>new mfValidatorChoice(array("choices"=> array(""=>"")+SystemVersionsFile::getModules()->toArray(),"key"=>true,"required"=>false)),                            
                        //  "meta_title"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getProductI18nFieldValuesForSelect('meta_title',$this->getSite()),"key"=>true,"required"=>false)),                            
                        //  "reference"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getProductI18nFieldValuesForSelect('reference',$this->getSite()),"key"=>true,"required"=>false)),                            
                        //  "customer_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getCustomerFieldValuesForSelect($this->getSite()),"key"=>true,"required"=>false)),
                        ),array("required"=>false)),                                         
            'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","*"=>"*"),"key"=>true)),                    
        ));   
       //$this->getSite() ??? => Call to undefined method SystemVersionsDetailsFormFilter::getSite().
    }
    
    
    
}

