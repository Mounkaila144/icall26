<?php


class CustomerMeetingsFormFilter extends mfFormFilterBase {

    protected $site=null,$language=null,$user=null,$objects=array();
    
    function __construct($user,$site=null)
    {                
       $this->site=$site; 
       $this->user=$user;
       $this->language=$user->getCountry();
       $this->conditions=new ConditionsQuery();   
       $this->_query= new mfQuery();
       parent::__construct();      
    }        
    
    function getLanguage()
    {
      return $this->language;    
    }
    
    function getSite()
    {
     return $this->site;
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    
    function configure()
    {         
       $cols=array('id','date','customer','phone','postcode','city','is_confirmed'); //,'telepro','sales','state');
       
       $this->objects=array('CustomerMeeting',
                            'Customer','CustomerAddress',
                            'CustomerMeetingStatus',
                            'CustomerMeetingStatusI18n',
                            'telepro'=>'User','sale'=>'User','sale2'=>'User'); 
       $this->setDefaults(array(               
            'order'=>array(
                            "in_at"=>"desc",                            
            ),        
            'equal'=>array(
                  //  "created_at"=>date("Y-m-d"),
                'is_active'=>'ACTIVE'
            ),
            'range'=>array(
               //  "in_at"=>array("from"=>date("Y-m-d H:i:s")),
              //  "created_at"=>array("from"=>date("Y-m-d")),
            ),
            'nbitemsbypage'=>"100",
            'cols'=>$cols,
       ));          
       $this->setClass('CustomerMeeting');
       //$this->setExcludeFields(array('team_id'));
       $this->setFields(array(          
           'lastname'=>'Customer',
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
                         ),
            'team_id'=>null
           ));
               
        $this->setQuery($this->_query->select("{fields}")
                        ->from(CustomerMeeting::getTable())
                        ->left(CustomerMeeting::getOuterForJoin('customer_id'))
                ->left(CustomerAddress::getInnerForJoin('customer_id'))
                ->left(CustomerMeeting::getOuterForJoin('telepro_id','telepro'))
                ->left(CustomerMeeting::getOuterForJoin('sales_id','sale'))
                ->left(CustomerMeeting::getOuterForJoin('sale2_id','sale2'))
                ->left(CustomerMeeting::getOuterForJoin('state_id'))
                ->left(CustomerMeetingStatusI18n::getInnerForJoin('status_id')." AND lang='{lang}'")
                ); 
       
      
       // Validators              
       $this->setValidators(array( 
                  
            'order' => new mfValidatorSchema(array(
                                                        "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                    
                                                        "in_at"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                                                        "lastname"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),     
                                                        "postcode"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)), 
                                                        "city"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)), 
                                                       ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(   
                             "id"=>new mfValidatorString(array("required"=>false)),                            
                             "lastname"=>new mfValidatorString(array("required"=>false)),  
                             "phone"=>new mfValidatorString(array("required"=>false)),  
                           //  "postcode"=>new mfValidatorString(array("required"=>false)),  
                             "city"=>new mfValidatorString(array("required"=>false)),                                               
                            ),array("required"=>false)),    
            'begin' => new mfValidatorSchema(array(                                
                             "postcode"=>new mfValidatorString(array("required"=>false)),                                                                          
                            ),array("required"=>false)), 
            'range' => new mfValidatorSchema(array(                             
                              "in_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),   
                              "created_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),  
                            ),array("required"=>false)),    
            'in'=>new mfValidatorSchema(array( 
                         'telepro_id'=>new mfValidatorChoice(array("choices"=>CustomerMeetingUtils::getTeleproUsers($this->getConditions(),$this->getSite()),'multiple'=>true,'key'=>true,'required'=>false)),
                         'sales_id'=>new mfValidatorChoice(array("choices"=>CustomerMeetingUtils::getSalesUsers($this->getConditions(),$this->getSite()),'multiple'=>true,'key'=>true,'required'=>false)),
                         'sale2_id'=>new mfValidatorChoice(array("choices"=>CustomerMeetingUtils::getSalesUsers2($this->getConditions(),$this->getSite()),'multiple'=>true,'key'=>true,'required'=>false)),
                         'team_id'=>new mfValidatorChoice(array("choices"=>CustomerMeetingUtils::getTeams($this->getConditions(),$this->getSite()),'multiple'=>true,'key'=>true,'required'=>false)),
                         'state_id'=>new mfValidatorChoice(array("choices"=>CustomerMeetingUtils::getStates($this->getLanguage(),$this->getConditions(),$this->getSite()),'multiple'=>true,'key'=>true,'required'=>false)),
                    ),array("required"=>false)),   
            'equal' => new mfValidatorSchema(array(     
                            //  "created_at"=>new mfValidatorI18nDate(array('required'=>false)),
                              "telepro_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerMeetingUtils::getTeleproUsersForSelect($this->getConditions(),$this->getSite()),"key"=>true,"required"=>false)),          
                              "sales_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerMeetingUtils::getSalesUsersForSelect($this->getConditions(),$this->getSite()),"key"=>true,"required"=>false)),                                           
                              "sale2_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerMeetingUtils::getSalesUsers2ForSelect($this->getConditions(),$this->getSite()),"key"=>true,"required"=>false)),                                           
                              "state_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerMeetingUtils::getStatusForSelect($this->getLanguage(),$this->getConditions(),$this->getSite()),"key"=>true,"required"=>false)),
                              "is_confirmed"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>"YES","NO"=>"NO"),"key"=>true,"required"=>false)),          
                              "status"=>new mfValidatorChoice(array("choices"=>array(""=>"","ACTIVE"=>"ACTIVE","DELETE"=>"DELETE"),"key"=>true,"required"=>false)),
                            ),array("required"=>false)), 
            'sizes' => new mfValidatorSchema(array(                                                      
                             
                            ),array("required"=>false)),
            'date_rdv'=>new mfValidatorBoolean(),
            'cols'=>new mfValidatorChoice(array("choices"=>$cols,'multiple'=>true,'required'=>false,'empty_value'=>array())),
            'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","250"=>"250","500"=>"500","*"=>"*"),"key"=>true)),                               
        ));    
       
       foreach (array('customer','date','phone','mobile','postcode','city') as $cols)
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
       if ($this['date_rdv']->getValue())
       {                
           $this->values['range']['created_at']=$this->values['range']['in_at'];        
           unset($this->values['range']['in_at']);
           $this->setTimeForDate('created_at');        
       }   
       else
       {    
          unset($this->values['range']['created_at']); 
          $this->setTimeForDate('in_at');         
       }   
       if (isset($this->values['in']['team_id']))
       {          
         //  var_dump($this['in']['team_id']->getValue());
           $this->insertTeleproAndSaleFromTeamsInQuery();
       }   
       return parent::getQuery();
    }
    
    function _extractParameterForUrl($name) 
    {
        if ($name=='range')
        {               
            $values=$this['range']->getValue();            
            if ($this['date_rdv']->getValue())
            {   
                if (isset($values['created_at']))
                {
                    foreach ($values['created_at'] as $name=>$value)               
                        $values['created_at'][$name]=format_date($value,"a");                
                }
            }
            else
            {    
                if (isset($values['in_at']))
                {
                    foreach ($values['in_at'] as $name=>$value)               
                        $values['in_at'][$name]=format_date($value,"a");                
                }
            }
            return $values;
        }    
        return parent::_extractParameterForUrl($name);
    }
    
    protected function insertTeleproAndSaleFromTeamsInQuery()
    {
          $params=array();         
           // Telepro
           $telepros=UserTeamUtils::getTeleproUsersByIdFromTeams($this['in']['team_id']->getValue());
           if ($telepros)
              $params[]=CustomerMeeting::getTableField('telepro_id')." IN('".implode("','",$telepros)."')"; 
           // Sale1 & Sale2
           $sales=UserTeamUtils::getSalesUsersByIdFromTeams($this['in']['team_id']->getValue());
           if ($sales)
           {
               $params[]=CustomerMeeting::getTableField('sales_id')." IN('".implode("','",$telepros)."')"; 
               $params[]=CustomerMeeting::getTableField('sale2_id')." IN('".implode("','",$telepros)."')"; 
           }   
           // Assistant ?
           if ($params)
           {    
                $where=implode(" OR ",$params);
                //var_dump($where);               
                $this->replaceWhereParameters($where);
           }           
    }
}

