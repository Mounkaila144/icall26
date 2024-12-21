<?php

class dialogListFilterContractsFormFilter extends mfFormFilterBase {
        
   protected $site=null,$language=null,$objects=array(),$conditions=null;
    
    function __construct($user,$site=null)
    {                
       $this->site=$site; 
       $this->user=$user;
       $this->language=$user->getCountry();    
       $this->conditions=new ConditionsQuery();
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
    
    protected function getSite()
    {
        return $this->site;
    }
    
    function configure()
    {
        $this->objects=array('CustomerContract',
                            'Customer','CustomerAddress',
                            'CustomerContractStatus',
                            'CustomerContractStatusI18n',
                            //'Partner',
                            'telepro'=>'User','sale1'=>'User','sale2'=>'User'
           ); 
       $this->setDefaults(array(                                
                                 'order'=>array("opened_at"=>"desc"),
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
                        // " GROUP BY ".CustomerContract::getTableField('id').
                       ";"); 
       // Validators 
       $this->setValidators(array(               
            'selected'=>new ObjectExistsValidator('CustomerContract',array('required'=>false),$this->getSite()),  
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
                                "telepro_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerContractUtils::getTeleproUsersForSelect($this->getConditions(),$this->getSite()),"key"=>true,"required"=>false)),          
                                "sale_1_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerContractUtils::getSalesUsers1ForSelect($this->getConditions(),$this->getSite()),"key"=>true,"required"=>false)),                                           
                                "sale_2_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerContractUtils::getSalesUsers2ForSelect($this->getConditions(),$this->getSite()),"key"=>true,"required"=>false)),                                           
                                "state_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerContractUtils::getStatusForSelect($this->getLanguage(),$this->getConditions(), $this->getSite()),"key"=>true,"required"=>false)),                                                         
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