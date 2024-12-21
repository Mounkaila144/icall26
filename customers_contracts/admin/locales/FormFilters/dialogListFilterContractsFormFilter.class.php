<?php

class dialogListFilterContractsFormFilter extends mfFormFilterBase {
        
   protected $language=null,$objects=array(),$conditions=null;
    
    function __construct($user)
    {                       
       $this->user=$user;
       $this->language=$user->getCountry();    
       $this->conditions=new ConditionsQuery();
       $this->settings=CustomerContractSettings::load();    
       $this->conditions->setParameters(array('user_id'=>$this->getUser()->getGuardUser()->get('id')));
       parent::__construct();      
    } 
        
     function getUser()
    {
        return $this->user;
    }
    
    function getLanguage()
    {
      return $this->language;    
    }
    
    function getSettings()
    {
        return $this->settings;
    }
    
    
    function configure()
    {
       if ($this->getUser()->hasCredential(array(array('filter_contract_telepro','filter_dialog_contract_telepro'))))    
       {                  
           $this->conditions->setWhere(CustomerContract::getTableField('telepro_id')."='{user_id}' "
                                      );           
       }
       elseif ($this->getUser()->hasCredential(array(array('filter_contract_commercial','filter_dialog_contract_commercial'))))   
       {                  
           $this->conditions->setWhere("(".CustomerContract::getTableField('sale_1_id')."='{user_id}' OR ".
                                       CustomerContract::getTableField('sale_2_id')."='{user_id}'".
                                       ") "
                                      );         
       }   
       elseif ($this->getUser()->hasCredential(array(array('filter_contract_telepro_manager','filter_dialog_contract_telepro_manager'))))
       {       
            $this->conditions->setWhere(CustomerContract::getTableField('telepro_id')." IN('".implode("','",array_keys($this->getUser()->getGuardUser()->getTeamUsers()))."')"                                       
                                      );    
       }       
       elseif ($this->getUser()->hasCredential(array(array('filter_contract_sales_manager','filter_dialog_contract_sales_manager'))))
       {       
            $this->conditions->setWhere(CustomerContract::getTableField('telepro_id')." IN('".implode("','",array_keys($this->getUser()->getGuardUser()->getTeamUsers()))."')"
                                      
                                      );    
       } 
       elseif ($this->getSettings()->hasAssistant() && $this->getUser()->hasCredential(array(array('filter_dialog_contract_assistant'))))
       {
           $this->conditions->setWhere("(".CustomerContract::getTableField('assistant_id')."='{user_id}' ".                                      
                                       " AND ".CustomerContract::getTableField('status')."='ACTIVE' "
                                      );
       }
       mfContext::getInstance()->getEventManager()->notify(new mfEvent($this, 'contracts.filter.credentials'));  
        $this->objects=array('CustomerContract',
                            'Customer','CustomerAddress',
                            'CustomerContractStatus',
                            'CustomerContractStatusI18n',
                            //'Partner',
                            'telepro'=>'User','sale1'=>'User','sale2'=>'User'
           ); 
       $this->setDefaults(array(                                
                                 'order'=>array("opened_at"=>"asc"),
                                 'nbitemsbypage'=>"10"
                           ));
       $this->setFields(array('lastname'=>'Customer',
                              'postcode'=>'CustomerAddress',                             
                              'lastname'=>array(
                                            'class'=>'Customer',
                                            'search'=>array('conditions'=>
                                                 "(".
                                                 Customer::getTableField('lastname')." COLLATE UTF8_GENERAL_CI LIKE '%%{lastname}%%' OR ".
                                                 Customer::getTableField('firstname')." COLLATE UTF8_GENERAL_CI LIKE '%%{lastname}%%'".
                                                 ")")
                              ),
                              'phone'=>array('class'=>'Customer',
                                             'search'=>array('conditions'=>
                                                 "(".
                                                 Customer::getTableField('phone')." LIKE '%%{phone}%%' OR ".
                                                 Customer::getTableField('mobile')." LIKE '%%{phone}%%'".
                                                 ")")
                                            ),
                              'city'=>array('class'=>'CustomerAddress',
                                            'search'=>array('conditions'=>CustomerAddress::getTableField('city')." COLLATE UTF8_GENERAL_CI LIKE '%%{city}%%'")
                                    )
            ));
      $this->setClass('CustomerContract');
       // Base Query      
       $this->setQuery("SELECT {fields} FROM ".CustomerContract::getTable().
                       " LEFT JOIN ".CustomerContract::getOuterForJoin('customer_id').                
                       " LEFT JOIN ".CustomerAddress::getInnerForJoin('customer_id'). 
                       " LEFT JOIN ".CustomerContract::getOuterForJoin('telepro_id','telepro'). 
                       " LEFT JOIN ".CustomerContract::getOuterForJoin('sale_1_id','sale1'). 
                       " LEFT JOIN ".CustomerContract::getOuterForJoin('sale_2_id','sale2').
                       " LEFT JOIN ".CustomerContract::getOuterForJoin('state_id'). 
                     //  " LEFT JOIN ".CustomerContract::getOuterForJoin('financial_partner_id'). 
                     //  " LEFT JOIN ".CustomerContractProduct::getInnerForJoin('contract_id'). 
                       " LEFT JOIN ".CustomerContractStatusI18n::getInnerForJoin('status_id')." AND lang='{lang}'". 
                       " WHERE ".CustomerContract::getTableField('status')."='ACTIVE'".   
                        $this->conditions->getWhere('AND'). 
                       ";"); 
       // Validators 
       $this->setValidators(array(               
            'selected'=>new ObjectExistsValidator('CustomerContract',array('required'=>false)),  
            'order' => new mfValidatorSchema(array(
                                                     //   "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                      
                                                        "opened_at"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                                                        "lastname"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),  
                                                        "phone"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),  
                                                        "postcode"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)), 
                                                        "city"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                    
                                                       ),array("required"=>false,"default_if_empty"=>true)), 
            'search' => new mfValidatorSchema(array(   
                             "lastname"=>new mfValidatorString(array("required"=>false)),  
                             "phone"=>new mfValidatorString(array("required"=>false)),                             
                             "city"=>new mfValidatorString(array("required"=>false)),                                                    
                            ),array("required"=>false)), 
             'begin' => new mfValidatorSchema(array(                               
                              "postcode"=>new mfValidatorString(array("required"=>false)),                                                                        
                            ),array("required"=>false)),  
            'range' => new mfValidatorSchema(array(                             
                              "opened_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                                     
                            ),array("required"=>false)),    
             'equal' => new mfValidatorSchema(array(                                                      
                                "telepro_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerContractUtils::getTeleproUsersForSelect($this->getConditions(),$this->getUser()),"key"=>true,"required"=>false)),          
                                "sale_1_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerContractUtils::getSalesUsers1ForSelect($this->getConditions(),$this->getUser()),"key"=>true,"required"=>false)),                                           
                                "sale_2_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerContractUtils::getSalesUsers2ForSelect($this->getConditions(),$this->getUser()),"key"=>true,"required"=>false)),                                           
                                "state_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerContractUtils::getStatusForSelect($this->getLanguage(),$this->getConditions()),"key"=>true,"required"=>false)),                                                           
                            ),array("required"=>false)),                                                                                  
            'nbitemsbypage'=>new mfValidatorChoice(array("choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","250"=>"250","500"=>"500","*"=>"*"),"key"=>true,"required"=>false)),                    
        ));
    }
    
     function getObjectsForPager()
    {
        return $this->objects;
    }
    
    function getConditions()
    {               
        return $this->conditions;
    }
}