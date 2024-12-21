<?php


class DomoprimeQuotationFormFilter extends mfFormFilterBase {

    protected $user=null,$language=null;
    
    function __construct($user) {
        $this->user=$user;
          $this->language=$user->getCountry();
            $this->conditions=new ConditionsQuery(); 
        $this->_query=new mfQuery();
        parent::__construct();
    }
    
     function getLanguage()
    {
      return $this->language;    
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function getMfQuery()
    {
        return $this->_query;
    }
    
    function configure()
    {                          
       $this->setDefaults(array(
           
            'order'=>array(
                            "created_at"=>"desc",                        
            ),            
            'nbitemsbypage'=>"100",
       ));          
       $this->setClass('DomoprimeQuotation');
       $this->setFields(array(
                            "opened_at"=>"CustomerContract",   
                            "opc_at"=>"CustomerContract",
                               'state_id'=>'CustomerContract',
                               'postcode'=>'CustomerAddress',    
                              'lastname'=>array(
                                            'class'=>'Customer',
                                            'search'=>array('conditions'=>
                                                 "(".
                                                 Customer::getTableField('lastname')." COLLATE UTF8_GENERAL_CI LIKE '%%{lastname}%%' OR ".
                                                 Customer::getTableField('firstname')." COLLATE UTF8_GENERAL_CI LIKE '%%{lastname}%%' OR ".
                                                 Customer::getTableField('company')." COLLATE UTF8_GENERAL_CI LIKE '%%{lastname}%%' OR ".                                              
                                                 CustomerContract::getTableField('reference')." COLLATE UTF8_GENERAL_CI LIKE '%%{lastname}%%' OR ".                                      
                                                  CustomerMeeting::getTableField('reference')." COLLATE UTF8_GENERAL_CI LIKE '%%{lastname}%%'".     
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
                                            'search'=>array('conditions'=>CustomerAddress::getTableField('city')." COLLATE UTF8_GENERAL_CI LIKE '%%{city}%%'"))
                              ));   
    /*   $this->setQuery("SELECT {fields} FROM ".DomoprimeQuotation::getTable().  
                       " LEFT JOIN ".DomoprimeQuotation::getOuterForJoin('creator_id').  
                       " INNER JOIN ".DomoprimeQuotation::getOuterForJoin('customer_id').  
                       " LEFT JOIN ".DomoprimeQuotation::getOuterForJoin('contract_id').  
                       ";"); */
       
       $this->_query->select("{fields}")
                     ->from(DomoprimeQuotation::getTable())
                     ->left(DomoprimeQuotation::getOuterForJoin('creator_id'))
                     ->inner(DomoprimeQuotation::getOuterForJoin('customer_id'))
                     ->left(DomoprimeQuotation::getOuterForJoin('contract_id'))
                     ->left(DomoprimeQuotation::getOuterForJoin('meeting_id')
               //      ->inner(CustomerContract::getOuterForJoin('polluter_id')
               );
                
                
       // Validators 
       $this->setValidators(array( 
                  
            'order' => new mfValidatorSchema(array(
                                                        "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                    
                                                        "dated_at"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                                                       "created_at"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),             
                                                       ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(   
                           "lastname"=>new mfValidatorString(array("required"=>false)),                             
                             "phone"=>new mfValidatorString(array("required"=>false)),                               
                            "reference"=>new mfValidatorString(array("required"=>false)),   
                            "city"=>new mfValidatorString(array("required"=>false)),                     
                            ),array("required"=>false)),                             
            'range' => new mfValidatorSchema(array(   
                            "dated_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                               
                            "opened_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),   
                            "opc_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                            ),array("required"=>false)),  
            'in'=>new mfValidatorSchema(array(                          
                          'state_id'=>new mfValidatorChoice(array("choices"=>CustomerContractUtils::getStates($this->getLanguage(),$this->getConditions()),'multiple'=>true,'key'=>true,'required'=>false)),                                                 
                    ),array("required"=>false)), 
            'equal' => new mfValidatorSchema(array(  
                        'is_last'=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>__("YES"),"NO"=>__("NO")),"key"=>true,"required"=>false)),
                        'contract_id'=>new ObjectExistsFilterValidator('CustomerContract',array("required"=>false)),
                        'meeting_id'=>new ObjectExistsFilterValidator('CustomerMeeting',array("required"=>false)),
                           // "lang"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getLanguagesSort($this->getSite()),"key"=>true,"required"=>false)),                            
                          //  "meta_title"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getProductI18nFieldValuesForSelect('meta_title',$this->getSite()),"key"=>true,"required"=>false)),                            
                          //  "reference"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getProductI18nFieldValuesForSelect('reference',$this->getSite()),"key"=>true,"required"=>false)),                            
                          "is_signed"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>__("YES"),"NO"=>__("NO")),"key"=>true,"required"=>false)),
                            ),array("required"=>false)),      
            'date_install'=>new mfValidatorBoolean(),    
            'date_quotation'=>new mfValidatorBoolean(),    
            'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","*"=>"*"),"key"=>true)),                    
        ));       

       $this->setQuery((string)$this->_query);       
    }
    

    function _extractParameterForUrl($name) 
    {
      /*  if ($name=='range')
        {
            $values=$this['range']->getValue();                        
            if (isset($values['date']))
            {
                foreach ($values['date'] as $name=>$value)          
                {                           
                   $values['date'][$name]=$value?format_date(date("Y-m-d",strtotime($value)),"a"):null;  // Remove time
                }                          
            }                            
            return $values;
        }    */
        return parent::_extractParameterForUrl($name);
    }
    
    function setTimeForDate($name)
     {
          if ($this->values['range'][$name]['to'])
          {    
            $this->values['range'][$name]['to'].=" 23:59:59";              
          }
          if ($this->values['range'][$name]['from'])
          {
             $this->values['range'][$name]['from'].=" 00:00:00";    
          }  
     }
     
      function getQuery()
    {  
       if ($this->query_valid)
            return $this->query;     
       if ($this['date_install']->getValue())
       {
           $this->values['range']['opc_at']=$this->values['range']['dated_at'];        
           unset($this->values['range']['dated_at']);
           $this->setTimeForDate('opc_at');              
       }    
       elseif ($this['date_quotation']->getValue())
       {
           
       } 
       else
       {
           $this->values['range']['opened_at']=$this->values['range']['dated_at'];        
           unset($this->values['range']['dated_at']);
           $this->setTimeForDate('opened_at');  
       }        
      // var_dump($this->query);
       if ($this->values['equal']['contract_id'])
           $this->query=str_replace(";"," INNER JOIN ".CustomerContract::getOuterForJoin('polluter_id').";",$this->query);
       elseif ($this->values['equal']['meeting_id'])
           $this->query=str_replace(";"," INNER JOIN ".CustomerMeeting::getOuterForJoin('polluter_id').";",$this->query);
       return parent::getQuery();
    }
    
     function getConditions()
    {               
        return $this->conditions;
    }
    
     
    function getDateFilter($name)
    {      
        if ($this['date_install']->getValue())
            return $this['range']['opc_at'][$name]->getValue();  
         if ($this['date_quotation']->getValue())
            return $this['range']['dated_at'][$name]->getValue();  
        return $this['range']['opened_at'][$name]->getValue();       
    }
}

