<?php


class DomoprimeCalculationFormFilter extends mfFormFilterBase {

    protected $user=null;
    
    function __construct($user)
    {                         
       $this->user=$user;
       $this->settings=CustomerMeetingSettings::load();          
       parent::__construct();      
    }    
     
    function getUser()
    {
        return $this->user;
    }
    
    function getSettings()
    {
        return $this->settings;
    }
    
    function configure()
    {          
       $polluter_query="";
       $this->setDefaults(array(
           
            'order'=>array(
                            "created_at"=>"desc",                        
            ),            
            'equal'=>array('isLast'=>'YES'),
            'nbitemsbypage'=>"100",
       ));          
       $this->setClass('DomoprimeCalculation');
       $this->setFields(array( 'lastname'=>array(
                                            'class'=>'Customer',
                                            'search'=>array('conditions'=>
                                                 "(".
                                                 Customer::getTableField('lastname')." COLLATE UTF8_GENERAL_CI LIKE '%%{lastname}%%' OR ".
                                                 Customer::getTableField('firstname')." COLLATE UTF8_GENERAL_CI LIKE '%%{lastname}%%'".
                                                 ")")
                                ),
                                'phone'=>array(
                                            'class'=>'Customer',
                                            'search'=>array('conditions'=>
                                                 "(".
                                                 Customer::getTableField('phone')." LIKE '%%{phone}%%' OR ".
                                                 Customer::getTableField('mobile')." LIKE '%%{mobile}%%'".
                                                 ")")
                                ),
           
                ));
       if ($this->getSettings()->hasPolluter())
       {                               
           $polluter_query=" LEFT JOIN ".DomoprimeCalculation::getOuterForJoin('polluter_id');
       } 
       $this->setQuery("SELECT {fields} FROM ".DomoprimeCalculation::getTable().    
                       " LEFT JOIN ".DomoprimeCalculation::getOuterForJoin('meeting_id'). 
                       " LEFT JOIN ".DomoprimeCalculation::getOuterForJoin('contract_id'). 
                       " INNER JOIN ".DomoprimeCalculation::getOuterForJoin('customer_id').                      
                       " INNER JOIN ".DomoprimeCalculation::getOuterForJoin('user_id','creator').  
                       " LEFT JOIN ".DomoprimeCalculation::getOuterForJoin('accepted_by_id','acceptor').  
                       " INNER JOIN ".DomoprimeCalculation::getOuterForJoin('region_id').  
                       " INNER JOIN ".DomoprimeCalculation::getOuterForJoin('zone_id').  
                       " INNER JOIN ".DomoprimeZone::getOuterForJoin('sector_id').  
                       " INNER JOIN ".DomoprimeCalculation::getOuterForJoin('energy_id').  
                       " LEFT JOIN ".DomoprimeEnergyI18n::getInnerForJoin('energy_id')." AND ".DomoprimeEnergyI18n::getTableField('lang')."='{lang}'".
                       " INNER JOIN ".DomoprimeCalculation::getOuterForJoin('class_id').
                       " LEFT JOIN ".DomoprimeClassI18n::getInnerForJoin('class_id'). " AND ".DomoprimeClassI18n::getTableField('lang')."='{lang}'".                                                                       
                       $polluter_query.
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
                             "phone"=>new mfValidatorString(array("required"=>false)),                            
                           "lastname"=>new mfValidatorString(array("required"=>false)),                        
                            ),array("required"=>false)),                             
            'range' => new mfValidatorSchema(array(   
                          //  "created_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                           // "expired_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                            ),array("required"=>false)),
            'in'=>new mfValidatorSchema(array(                         
                    ),array("required"=>false)),   
            'equal' => new mfValidatorSchema(array(   
                           // "lang"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getLanguagesSort($this->getSite()),"key"=>true,"required"=>false)),                            
                              "isLast"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>__("YES"),"NO"=>__("NO")),"key"=>true,"required"=>false)),                            
                          //  "reference"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getProductI18nFieldValuesForSelect('reference',$this->getSite()),"key"=>true,"required"=>false)),                            
                          //  "customer_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getCustomerFieldValuesForSelect($this->getSite()),"key"=>true,"required"=>false)),
                            ),array("required"=>false)),                                        
            'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","*"=>"*"),"key"=>true)),                    
        ));  
        if ($this->getSettings()->hasPolluter() && $this->getUser()->hasCredential(array(array('superadmin','admin','app_domoprime_view_list_polluter'))))
       {
           $this->equal->addValidator("polluter_id",new mfValidatorChoice(array("choices"=>DomoprimeCalculation::getPollutersForSelect(),'key'=>true,'required'=>false)));
           $this->in->addValidator('polluter_id',new mfValidatorChoice(array("choices"=>DomoprimeCalculation::getPolluters(),'multiple'=>true,'key'=>true,'required'=>false)));
       } 
    }
    

    
    
}

