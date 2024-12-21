<?php


class DomoprimeBillingFormFilter extends mfFormFilterBase {

     
    
    function configure()
    {                          
       $this->setDefaults(array(
           
            'order'=>array(
                            "dated_at"=>"desc",                        
            ),            
            'nbitemsbypage'=>"100",
       ));          
       $this->setClass('DomoprimeBilling');
        $this->setFields(array(//'lastname'=>'Customer',
                               'state_id'=>'CustomerContract',
                              'postcode'=>'CustomerAddress',                             
                              'lastname'=>array(
                                            'class'=>'Customer',
                                            'search'=>array('conditions'=>
                                                 "(".
                                                 Customer::getTableField('lastname')." COLLATE UTF8_GENERAL_CI LIKE '%%{lastname}%%' OR ".
                                                 Customer::getTableField('firstname')." COLLATE UTF8_GENERAL_CI LIKE '%%{lastname}%%' OR ".
                                                 Customer::getTableField('company')." COLLATE UTF8_GENERAL_CI LIKE '%%{lastname}%%' OR ".                                              
                                                 CustomerContract::getTableField('reference')." COLLATE UTF8_GENERAL_CI LIKE '%%{lastname}%%'".                                                
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
       $this->setQuery("SELECT {fields} FROM ".DomoprimeBilling::getTable().                        
                       " INNER JOIN ".DomoprimeBilling::getOuterForJoin('customer_id').  
                       " INNER JOIN ".DomoprimeBilling::getOuterForJoin('contract_id').  
                       " INNER JOIN ".CustomerAddress::getInnerForJoin('customer_id').
                       " LEFT JOIN ".CustomerContract::getOuterForJoin('state_id').
                       " INNER JOIN ".CustomerContract::getOuterForJoin('polluter_id').
                       " LEFT JOIN ".CustomerContractStatusI18n::getInnerForJoin('status_id')." AND ".CustomerContractStatusI18n::getTableField('lang')."='{lang}'".
                       ";"); 
       // Validators 
       $this->setValidators(array( 
                  
            'order' => new mfValidatorSchema(array(
                                                        "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                    
                                                       "dated_at"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                                                       "created_at"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
                                                       ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(   
                            "phone"=>new mfValidatorString(array("required"=>false)),                            
                           "city"=>new mfValidatorString(array("required"=>false)),                            
                            "lastname"=>new mfValidatorString(array("required"=>false)),                            
                            "reference"=>new mfValidatorString(array("required"=>false)),  
                            ),array("required"=>false)),                             
            'range' => new mfValidatorSchema(array(   
                               "dated_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                           
                           // "expired_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                            ),array("required"=>false)),    
           'begin' => new mfValidatorSchema(array(   
                          "postcode"=>new mfValidatorString(array("required"=>false)),                            
                            ),array("required"=>false)),     
            'equal' => new mfValidatorSchema(array(   
                        "state_id"=>new mfValidatorChoice(array("choices"=>array(""=>"","0"=>__('Not defined'))+CustomerContractStatusUtils::getStatusForI18nSelect(),"key"=>true,"required"=>false)),                         
                        'is_last'=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>__("YES"),"NO"=>__("NO")),"key"=>true,"required"=>false)),
                        'contract_id'=>new ObjectExistsValidator('CustomerContract'),
                           // "lang"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getLanguagesSort($this->getSite()),"key"=>true,"required"=>false)),                            
                          //  "meta_title"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getProductI18nFieldValuesForSelect('meta_title',$this->getSite()),"key"=>true,"required"=>false)),                            
                          //  "reference"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getProductI18nFieldValuesForSelect('reference',$this->getSite()),"key"=>true,"required"=>false)),                            
                          //  "customer_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getCustomerFieldValuesForSelect($this->getSite()),"key"=>true,"required"=>false)),
                            ),array("required"=>false)),                                        
            'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","*"=>"*"),"key"=>true)),                    
        ));              
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
       if ($this->values['range']['dated_at'])                 
           $this->setTimeForDate('dated_at');               
       return parent::getQuery();
    }
}

