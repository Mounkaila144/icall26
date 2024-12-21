<?php



class DomoprimeCalculationReportFormFilter extends mfFormFilterBase {

    function __construct($user) {
        $this->user=$user;
        $this->conditions=new ConditionsQuery(); 
        parent::__construct();
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function getLanguage()
    {
        return $this->getUser()->getLanguage();
    }
    
      function getConditions()
    {               
        return $this->conditions;
    }
    
    function configure()
    {                          
       $this->setDefaults(array(
           
            'order'=>array(
                            "created_at"=>"desc",                        
            ),                      
            'nbitemsbypage'=>"50",
            'equal'=>array(
                        "state_id"=>DomoprimeSettings::load()->get('install_in_progess_status_id')
            ),
            'mode'=>'surface'
       ));   
     //  if (!$this->getUser()->hasCredential(array(array('superadmin','filter_meeting_no_default_range_in_at'))))
     //  {    
          $this->setDefault('range', array("opc_at"=>array("from"=>date("Y-m-d")." 00:00:00",
                                                          "to"=>date("Y-m-d")." 23:59:59")));
    //   }       
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
                                'state_id'=>"CustomerContract",
                                'opc_at'=>"CustomerContract",
                                "financial_partner_id"=>"CustomerContract",
           
                ));
       $this->setQuery("SELECT {fields} FROM ".DomoprimeCalculation::getTable().    
                      // " INNER JOIN ".DomoprimeProductCalculation::getOuterForJoin('calculation_id').    
                       " INNER JOIN ".DomoprimeCalculation::getOuterForJoin('meeting_id').                      
                       " INNER JOIN ".CustomerContract::getInnerForJoin('meeting_id').                       
                       " INNER JOIN ".CustomerMeeting::getOuterForJoin('customer_id').                                     
                       " LEFT JOIN ".CustomerAddress::getInnerForJoin('customer_id'). 
                       " WHERE isLast='YES'".
                       " ORDER BY ".Customer::getTableField('lastname')." COLLATE UTF8_GENERAL_CI ASC".
                       ";"); 
       // Validators 
       $this->setValidators(array( 
                            
            'search' => new mfValidatorSchema(array(   
                          //  "id"=>new mfValidatorString(array("required"=>false)),                            
                           "phone"=>new mfValidatorString(array("required"=>false)),                            
                           "lastname"=>new mfValidatorString(array("required"=>false)),                        
                            ),array("required"=>false)),                             
            'range' => new mfValidatorSchema(array(   
                           "opc_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                  
                           // "expired_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                            ),array("required"=>false)),         
           'in'=>new mfValidatorSchema(array(                          
                          'state_id'=>new mfValidatorChoice(array("choices"=>CustomerContractUtils::getStates($this->getLanguage(),$this->getConditions()),'multiple'=>true,'key'=>true,'required'=>false)),                          
                    ),array("required"=>false)),   
            'equal' => new mfValidatorSchema(array(   
                            "financial_partner_id"=>new mfValidatorChoice(array("choices"=>CustomerContractUtils::getFinancialPartnersForSelect($this->getConditions(),$this->getUser()),'key'=>true,'required'=>false)),
                            "state_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerContractUtils::getStatusForSelect($this->getLanguage(),$this->getConditions()),"key"=>true,"required"=>false)),
                            "class_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+DomoprimeClass::getClassForI18nSelect(),"key"=>true,"required"=>false)),                            
                            "energy_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+DomoprimeEnergy::getEnergyI18nForSelect(),"key"=>true,"required"=>false)),
                            "sector_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+DomoprimeSector::getSectorForSelect(),"key"=>true,"required"=>false)),
                            "zone_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+DomoprimeZone::getZonesForSelect(),"key"=>true,"required"=>false)),
                            ),array("required"=>false)),                                        
            'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","*"=>"*"),"key"=>true)),                    
            'mode'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("mixed"=>__("mixed"),"surface"=>__("Surface"),"cumac"=>__("Cumac"),'cumac_value'=>__("Cumac value")),"key"=>true)),                    
        ));              
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
       $this->setTimeForDate('opc_at');                
       return parent::getQuery();
    }
    
   function getMode()
   {
       return $this['mode']->getValue();
   }
   
   function getFormatter()
    {
        if ($this->formatter===null)
        {
            $this->formatter=new DomoprimeCalculationReportFilterFormatter($this);
        }   
        return $this->formatter;
    }
       
    
    function getTotalSurfaces()
    {
        return DomoprimeCalculation::getTotalSurfacesForFormFilter($this);
    }        
    
    function getTotalCumacValues()
    {
       return DomoprimeCalculation::getTotalCumacValuesForFormFilter($this); 
    }
    
    function getTotalCumacs()
    {
        return DomoprimeCalculation::getTotalCumacsForFormFilter($this); 
    }
}

