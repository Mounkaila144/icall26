<?php


class RegistrationFormFilter extends mfFormFilter {
   
     protected $objects=array();
    
    
    function configure()
    {                         
       $this->setDefaults(array(           
            'order'=>array(
                            "id"=>"desc",                        
            ),     
            'equal'=>array(
                   // "status"=>"ACTIVE",
            ),
          'nbitemsbypage'=>"20",
       ));          
       $this->setClass('UtilsRegistration');
       $this->setFields(array('month'=>array(
                                        'class'=>'UtilsRegistration',
                                        'order'=>array('conditions'=>
                                            UtilsRegistration::getTableField('year')." {month},".
                                            UtilsRegistration::getTableField('month')." {month}"
                                        ),
                                        'search'=>array('conditions'=>
                                                 "(".
                                                 UtilsRegistration::getTableField('month')." LIKE '%%{month}%%' OR ".
                                                 UtilsRegistration::getTableField('year')." LIKE '%%{month}%%' ".                                                
                                                 ")")
                              ),
//                              'registration'=>array(
//                                            'class'=>'UtilsRegistration',
//                                            'search'=>array('conditions'=>
//                                                 "(".
//                                                 UtilsRegistration::getTableField('registration')." COLLATE UTF8_GENERAL_CI LIKE '%%{registration}%%' ".
//                                                 ")")
//                              ), 
           ));
       $this->setQuery("SELECT {fields} FROM ". UtilsRegistration::getTable().";"); 
       // Validators 
       $this->setValidators(array( 
                  
            'order' => new mfValidatorSchema(array(
                                                        "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                                                                     
                                                        "month"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                      
                                                        "registration"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)), 
                                                       ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(                 
                            "registration"=>new mfValidatorString(array("required"=>false)),   
                            "month"=>new mfValidatorString(array("required"=>false)),
                            ),array("required"=>false)),                             
            'range' => new mfValidatorSchema(array(   
                          //  "created_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                           // "expired_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                            ),array("required"=>false)),                                                         
            'equal' => new mfValidatorSchema(array(   
                             //"status_id"=>new mfValidatorChoice(array("choices"=>array(""=>"","0"=>__("---"))+CustomerContractBillingStatus::getStatusForI18nSelect(),"key"=>true,"required"=>false)),
                              //"status"=>new mfValidatorChoice(array("choices"=>array(""=>"","ACTIVE"=>__("ACTIVE"),"DELETE"=>__("DELETE")),"key"=>true,"required"=>false)),
                            ),array("required"=>false)),                                      
           'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","*"=>"*"),"key"=>true)),                    
        ));              
    }
    
    
    

    
}
