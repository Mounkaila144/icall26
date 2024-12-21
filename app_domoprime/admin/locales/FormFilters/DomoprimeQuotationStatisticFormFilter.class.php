<?php


class DomoprimeQuotationStatisticFormFilter extends mfFormFilterBase {

    protected $user=null;
    
    function __construct($user) {
        $this->user=$user;
        parent::__construct();
    }
    
    function getUser()
    {
        return $this->user;
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
       $this->setQuery("SELECT {fields} FROM ".DomoprimeQuotation::getTable().  
                       " LEFT JOIN ".DomoprimeQuotation::getOuterForJoin('creator_id').  
                       " INNER JOIN ".DomoprimeQuotation::getOuterForJoin('customer_id').  
                       " INNER JOIN ".DomoprimeQuotation::getOuterForJoin('contract_id').  
                       " WHERE is_signed = 'YES' ".
                       " GROUP BY ".DomoprimeQuotation::getTableField('contract_id').
                       ";"); 
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
                           // "expired_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                            ),array("required"=>false)),                                                         
            'equal' => new mfValidatorSchema(array(   
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

