<?php


class CustomerContractsFormFilter extends mfFormFilterBase {

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
    
    function getSite()
    {
     return $this->site;
    }
      
    function configure()
    {                   
       $cols=array('id','date','customer','phone','amount','postcode','city'); //,'telepro','sales','state');      
       $this->objects=array('CustomerContract',
                            'Customer','CustomerAddress',
                            'CustomerContractStatus',
                            'CustomerContractStatusI18n',
                            'Partner',
                            'telepro'=>'User','sale1'=>'User','sale2'=>'User'
           ); 
       $this->setDefaults(array(               
            'order'=>array(
                            "id"=>"desc",                            
            ),            
            'range'=>array(
               //  "in_at"=>array("from"=>date("Y-m-d H:i:s")),
            ),
           'equal'=>array(
               'status'=>'ACTIVE',
            ),
            'nbitemsbypage'=>"100",
            'cols'=>$cols,
       ));          
       $this->setClass('CustomerContract');
       $this->setFields(array('lastname'=>'Customer',
                              'postcode'=>'CustomerAddress',
                              'product_id'=>'CustomerContractProduct',   
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
       $this->setQuery("SELECT {fields} FROM ".CustomerContract::getTable().                      
                       " LEFT JOIN ".CustomerContract::getOuterForJoin('customer_id').                
                       " LEFT JOIN ".CustomerAddress::getInnerForJoin('customer_id'). 
                       " LEFT JOIN ".CustomerContract::getOuterForJoin('telepro_id','telepro'). 
                       " LEFT JOIN ".CustomerContract::getOuterForJoin('sale_1_id','sale1'). 
                       " LEFT JOIN ".CustomerContract::getOuterForJoin('sale_2_id','sale2').
                       " LEFT JOIN ".CustomerContract::getOuterForJoin('state_id'). 
                       " LEFT JOIN ".CustomerContract::getOuterForJoin('financial_partner_id'). 
                       " LEFT JOIN ".CustomerContractProduct::getInnerForJoin('contract_id'). 
                       " LEFT JOIN ".CustomerContractStatusI18n::getInnerForJoin('status_id')." AND lang='{lang}'".                      
                       ";"); 
       // Validators        
       $this->setValidators(array( 
                  
            'order' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                    
                            "opened_at"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "total_price_with_taxe"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "lastname"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),     
                            "postcode"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)), 
                            "phone"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),     
                            "city"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)), 
                            ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(   
                             "id"=>new mfValidatorString(array("required"=>false)),                            
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
            'in'=>new mfValidatorSchema(array( 
                          'telepro_id'=>new mfValidatorChoice(array("choices"=>CustomerContractUtils::getTeleproUsers($this->getConditions(),$this->getSite()),'multiple'=>true,'key'=>true,'required'=>false)),
                          'sale_1_id'=>new mfValidatorChoice(array("choices"=>CustomerContractUtils::getSalesUsers1($this->getConditions(),$this->getSite()),'multiple'=>true,'key'=>true,'required'=>false)),
                          'sale_2_id'=>new mfValidatorChoice(array("choices"=>CustomerContractUtils::getSalesUsers2($this->getConditions(),$this->getSite()),'multiple'=>true,'key'=>true,'required'=>false)),
                          'state_id'=>new mfValidatorChoice(array("choices"=>CustomerContractUtils::getStates($this->getLanguage(),$this->getConditions(),$this->getSite()),'multiple'=>true,'key'=>true,'required'=>false)),
                          'product_id'=>new mfValidatorChoice(array("choices"=>CustomerContractUtils::getProducts($this->getConditions(),$this->getSite()),'multiple'=>true,'key'=>true,'required'=>false)),
                          'team_id'=>new mfValidatorChoice(array("choices"=>CustomerContractUtils::getTeams($this->getConditions(),$this->getSite()),'multiple'=>true,'key'=>true,'required'=>false)),
                          "financial_partner_id"=>new mfValidatorChoice(array("choices"=>CustomerContractUtils::getFinancialPartners($this->getConditions(),$this->getSite()),'multiple'=>true,'key'=>true,'required'=>false)),
                    ),array("required"=>false)),   
            'equal' => new mfValidatorSchema(array(                                                      
                                "telepro_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerContractUtils::getTeleproUsersForSelect($this->getConditions(),$this->getSite()),"key"=>true,"required"=>false)),          
                                "sale_1_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerContractUtils::getSalesUsers1ForSelect($this->getConditions(),$this->getSite()),"key"=>true,"required"=>false)),                                           
                                "sale_2_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerContractUtils::getSalesUsers2ForSelect($this->getConditions(),$this->getSite()),"key"=>true,"required"=>false)),                                           
                                "state_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerContractUtils::getStatusForSelect($this->getLanguage(),$this->getConditions(), $this->getSite()),"key"=>true,"required"=>false)),
                                "product_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerContractUtils::getProductsForSelect('meta_title',$this->getConditions(),$this->getSite()),"key"=>true,"required"=>false)),
                                "status"=>new mfValidatorChoice(array("choices"=>array(""=>"","ACTIVE"=>"ACTIVE","DELETE"=>"DELETE"),"key"=>true,"required"=>false)),
                                "financial_partner_id"=>new mfValidatorChoice(array("choices"=>CustomerContractUtils::getFinancialPartners($this->getConditions(),$this->getSite()),'key'=>true,'required'=>false)),
                            ),array("required"=>false)), 
            'sizes' => new mfValidatorSchema(array(                                                      
                             
                            ),array("required"=>false)),
            'cols'=>new mfValidatorChoice(array("choices"=>$cols,'multiple'=>true,'required'=>false,'empty_value'=>array())),
            'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","250"=>"250","500"=>"500","*"=>"*"),"key"=>true)),                    
        ));    
       
       foreach (array('customer','date','phone','postcode','city','amount') as $cols)
       {
           $this->sizes->addValidator($cols,new mfValidatorInteger(array("required"=>false)));
       }    
    }
    
    function getObjectsForPager()
    {
        return $this->objects;
    }
    
    function hasObject($name)
    {             
        return in_array($name,$this->objects);
    }
    
    function hasColumn($name)
    {
        return in_array($name,(array)$this['cols']->getValue());
    }
   
    function getConditions()
    {               
        return $this->conditions;
    }
  
   /*  function getParametersForUrl()
    {
        if ($this->hasValues())
        { 
            $values=$this->getValues();
            unset($values['cols'],$values['sizes']);
            return $this->_getParametersForUrl($values);
        }
        return "";
    }*/
    
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
       $this->setTimeForDate('opened_at');         
       return parent::getQuery();
    }
    
    function _extractParameterForUrl($name) 
    {
        if ($name=='range')
        {
            $values=$this['range']->getValue();
            if (isset($values['opened_at']))
            {
                foreach ($values['opened_at'] as $name=>$value)               
                    $values['opened_at'][$name]=format_date($value,"a");                
            }    
            return $values;
        }    
        return parent::_extractParameterForUrl($name);
    }
}

