<?php


class UserValidationTokenFormFilter extends mfFormFilterBase {

     
    function configure()
    {                    
  
       $this->setDefaults(array(
          
            'order'=>array(
                            "id"=>"desc",                        
            ),            
            'nbitemsbypage'=>"100",
       ));          
       $this->setClass('UserValidationToken');
       $this->setFields(array());
       $this->setQuery("SELECT {fields} FROM ".UserValidationToken::getTable().                      
                       " INNER JOIN ".UserValidationToken::getOuterForJoin('user_id'). 
                       ";"); 
       // Validators 
       $this->setValidators(array( 
                  
            'order' => new mfValidatorSchema(array(
                                                        "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                    
                                                   //     "name"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                                                    //    "value"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
                                                       ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(   
                             "id"=>new mfValidatorString(array("required"=>false)),                            
                          //  "link"=>new mfValidatorString(array("required"=>false)),                            
                             "message"=>new mfValidatorString(array("required"=>false)),                            
                            ),array("required"=>false)),                             
            'range' => new mfValidatorSchema(array(   
                          //  "created_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                           // "expired_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                            ),array("required"=>false)),                                                         
            'equal' => new mfValidatorSchema(array(   
                           // "lang"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getLanguagesSort($this->getSite()),"key"=>true,"required"=>false)),                            
                             "user_id"=>new mfValidatorChoice(array("choices"=> UserValidationToken::getUsersForSelect()->asort()->unshift(array(''=>'')),"key"=>true,"required"=>false)),                            
                             "type"=>new mfValidatorChoice(array("choices"=> UserValidationToken::getTypesForSelect()->asort()->unshift(array(''=>'')),"key"=>true,"required"=>false)),                            
                          //  "reference"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getProductI18nFieldValuesForSelect('reference',$this->getSite()),"key"=>true,"required"=>false)),                            
                            "status"=>new mfValidatorChoice(array("choices"=>array(""=>"","ACTIVE"=>__("ACTIVE"),"DELETE"=>__("DELETE")),"key"=>true,"required"=>false)),
                            ),array("required"=>false)),                              
          
            'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","*"=>"*"),"key"=>true)),                    
        ));              
    }
   
    
}

