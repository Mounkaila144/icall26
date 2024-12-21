<?php

class SiteOversightUserActionFormFilter extends mfFormFilterBase {

    
    function configure()
    {                   
       
       $this->setDefaults(array(          
            'order'=>array(
                 "id"=>"desc",                        
            ),            
            'nbitemsbypage'=>"50",
       ));          
       $this->setClass('SiteOversightUserAction');
       $this->setFields(array());
       $this->setQuery("SELECT {fields} FROM ".SiteOversightUserAction::getTable().                       
                       " LEFT JOIN ".SiteOversightUserAction::getOuterForJoin('user_id','user').
                       " INNER JOIN ".SiteOversightUserAction::getOuterForJoin('creator_id','creator').
                       ";"); 
       // Validators 
       $this->setValidators(array( 
                  
            'order' => new mfValidatorSchema(array(
                             "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                           
                        ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(   
                             "message"=>new mfValidatorString(array("required"=>false)),                            
                             "action"=>new mfValidatorString(array("required"=>false)),                            
                             "module"=>new mfValidatorString(array("required"=>false)),                            
                            "ip"=>new mfValidatorString(array("required"=>false)), 
                        ),array("required"=>false)),                             
            'range' => new mfValidatorSchema(array(   
                            // "created_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                            // "expired_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                        ),array("required"=>false)),                                                         
            'equal' => new mfValidatorSchema(array(   
                            // "lang"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getLanguagesSort($this->getSite()),"key"=>true,"required"=>false)),                            
                            //  "meta_title"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getProductI18nFieldValuesForSelect('meta_title',$this->getSite()),"key"=>true,"required"=>false)),                            
                            //  "reference"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getProductI18nFieldValuesForSelect('reference',$this->getSite()),"key"=>true,"required"=>false)),                            
                               "user_id"=>new mfValidatorChoice(array("choices"=> SiteOversightUserAction::getUsersForSelect()->unshift(array(''=>'')),"key"=>true,"required"=>false)),
                               "creator_id"=>new mfValidatorChoice(array("choices"=> SiteOversightUserAction::getCreatorsForSelect()->unshift(array(''=>'')),"key"=>true,"required"=>false)),
                        ),array("required"=>false)),                                         
            'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","*"=>"*"),"key"=>true)),                    
        ));              
    }
    
}

