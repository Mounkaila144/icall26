<?php

require_once dirname(__FILE__)."/../Statistics/StatisticOperation.class.php";

class DomoprimeStatisticOperationFormFilter extends mfFormFilterBase {
    
    protected $lang=null,$sheet=null,$conditions=null;    
    
    function __construct($user,$defaults=array()) {           
         $this->lang=  $user->getCountry();       
         $this->user=$user;    
         $this->conditions=new ConditionsQuery(); 
         $this->settings=CustomerContractSettings::load();  
         parent::__construct($defaults,array());        
    }    
    
    function getUser()
    {
        return $this->user;
    }
    
      function getSettings()
    {
        return $this->settings;
    }
    
    protected function setCredentials()
    {
        $this->conditions->setParameters(array('user_id'=>$this->getUser()->getGuardUser()->get('id')));
     
        if ($this->getUser()->hasCredential(array(array('filter_app_domoprime_statistics_operations_telepro'))))    
       {                  
           $this->conditions->setWhere(CustomerContract::getTableField('telepro_id')."='{user_id}' AND ".
                                       CustomerContract::getTableField('status')."='ACTIVE'"
                                      );           
       }
       elseif ($this->getUser()->hasCredential(array(array('filter_app_domoprime_statistics_operations_commercial'))))   
       {                  
           $this->conditions->setWhere("(".CustomerContract::getTableField('sale_1_id')."='{user_id}' OR ".
                                       CustomerContract::getTableField('sale_2_id')."='{user_id}'".
                                       ") AND ".CustomerContract::getTableField('status')."='ACTIVE'"
                                      );         
       }      
       elseif ($this->getUser()->hasCredential(array(array('filter_app_domoprime_statistics_operations_telepro_manager'))))
       {       
            $team_users=$this->getUser()->getGuardUser()->getTeamUsers();                
            $condition=$team_users->isEmpty()?" IS NULL":" IN('".$team_users->getKeys()->implode("','")."')";    
            $this->conditions->setWhere(CustomerContract::getTableField('telepro_id').$condition." AND ".CustomerContract::getTableField('status')."='ACTIVE'"
                                      );    
       } 
      // elseif ($this->getUser()->hasGroups('sales_manager'))
       elseif ($this->getUser()->hasCredential(array(array('filter_app_domoprime_statistics_operations_sales_manager'))))
       {       
            $team_users=$this->getUser()->getGuardUser()->getTeamUsers();                
            $condition=$team_users->isEmpty()?" IS NULL":" IN('".$team_users->getKeys()->implode("','")."')";
            $this->conditions->setWhere(CustomerContract::getTableField('telepro_id').$condition." AND ".CustomerContract::getTableField('status')."='ACTIVE'"
                                      );    
       } 
       elseif ($this->getSettings()->hasAssistant() && $this->getUser()->hasCredential(array(array('filter_app_domoprime_statistics_operations_assistant'))))
       {
           $this->conditions->setWhere("(".CustomerContract::getTableField('assistant_id')."='{user_id}' ".
                                       " OR ".CustomerContract::getTableField('assistant_id')."=0 ) ".
                                       " AND ".CustomerContract::getTableField('status')."='ACTIVE' "
                                      );
       }
       elseif ($this->getSettings()->hasAssistant() && $this->getUser()->hasCredential(array(array('filter_app_domoprime_statistics_operations_assistant_owner'))))
       {
           $this->conditions->setWhere("(".CustomerContract::getTableField('assistant_id')."='{user_id}' ".                                      
                                       " AND ".CustomerContract::getTableField('status')."='ACTIVE' )"
                                      );
       }
    }
    
    function configure()
    {       
        $this->setCredentials();
        $this->sheet=new StatisticOperation($this->getUser());
       // $settings=StatisticSettings::load();      
      //  list($min,$max)=CustomerContractUtils::getContractMinAndMaxDate($this->conditions);
        $this->addDefaults(array_merge(array(              
            'range'=>array(
            //    "opened_at"=>array("to"=>$max,'from'=>$min),               
            ),          
       ),$this->getDefaults()));                   
       $this->setValidators(array( 
                                               
            'range' => new mfValidatorSchema(array(                             
                              "opened_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),   
                              "opc_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),
                            ),array("required"=>false)), 
            'begin' => new mfValidatorSchema(array(                             
                            "postcode"=>new mfValidatorMultiple(new mfValidatorString(array("required"=>false))),                       
                            ),array("required"=>false)),
            'in'=>new mfValidatorSchema(array( 
                        //  'product_id'=>new mfValidatorChoice(array("choices"=>CustomerContractUtils::getProducts($this->getConditions()),'multiple'=>true,'key'=>true,'required'=>false)),
                          'telepro_id'=>new mfValidatorChoice(array("choices"=>CustomerContractUtils::getTeleproUsers($this->getConditions(),$this->getUser()),'multiple'=>true,'key'=>true,'required'=>false)),
                          'sale_1_id'=>new mfValidatorChoice(array("choices"=>CustomerContractUtils::getSalesUsers1($this->getConditions(),$this->getUser()),'multiple'=>true,'key'=>true,'required'=>false)),
                          'sale_2_id'=>new mfValidatorChoice(array("choices"=>CustomerContractUtils::getSalesUsers2($this->getConditions(),$this->getUser()),'multiple'=>true,'key'=>true,'required'=>false)),                                                  
                          'team_id'=>new mfValidatorChoice(array("choices"=>CustomerContractUtils::getTeams($this->getConditions()),'multiple'=>true,'key'=>true,'required'=>false)),                        
                    ),array("required"=>false)),
            'date_install'=>new mfValidatorBoolean(),   
        //   'mode'=>new mfValidatorChoice(array('choices'=>$options,'key'=>true))
        ));    
        $this->setClass('CustomerContract');  
       // $this->setExcludeFields(array('product_id'));
        $this->setFields(array('postcode'=>'CustomerAddress',
                             //  'product_id'=>null
                               ));
        $this->setQuery("SELECT {fields} FROM ".CustomerContract::getTable().
                        " INNER JOIN ".CustomerContract::getOuterForJoin('customer_id').                
                        " INNER JOIN ".CustomerAddress::getInnerForJoin('customer_id').
                     //   " INNER JOIN ".DomoprimeCalculation::getInnerForJoin('contract_id').
                        " WHERE ".CustomerContract::getTableField('status')."='ACTIVE';");       
    }
    
    
    
    
    
    function execute()
    {                                
      //  $this->getConditions()->add($this->getWhere()," AND ");
      //  echo "Conditions=".$this->getConditions()->getWhere()."<br/>";
      //  echo "Having=".$this->getHaving()."<br/>";
      //   var_dump($this->getWhere());   
        $this->getConditions()->setWhere($this->getWhere());
     //   var_dump($this->getConditions()->getWhere(""));     
        $this->sheet->setConditions($this->getConditions());    
      //  var_dump($this->getConditions()->getWhere());     
        
        $this->sheet->execute();        
    }
    
    function getConditions()
    {
        return $this->conditions;
    }
    
    function getSheet()
    {
        return $this->sheet;
    }
  
    function getfilterToJson()
    {
        $filter=new CustomerContractsFormFilter($this->getUser());        
        return json_encode(array_merge(array(
            'token'=>$filter->getCSRFToken(),
            'in'=>array(),
            'equal'=>array('status'=>'ACTIVE')),
            $filter->getDefaults()));
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
           $this->values['range']['opc_at']=$this->values['range']['opened_at'];        
           unset($this->values['range']['opened_at']);
           $this->setTimeForDate('opc_at');        
       }   
       else
       {
            $this->setTimeForDate('opened_at');  
       }    
       
       return parent::getQuery();
    }
    
    function getDateFilter($name)
    {      
        if ($this['date_install']->getValue())
            return $this['range']['opc_at'][$name]->getValue();        
        return $this['range']['opened_at'][$name]->getValue();       
    }
}


