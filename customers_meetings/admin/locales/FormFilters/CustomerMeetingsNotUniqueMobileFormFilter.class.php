<?php


class CustomerMeetingsNotUniqueMobileFormFilter extends mfFormFilterBase {

    protected $language=null,$user=null,$conditions=null;
    
    function __construct($user)
    {                      
       $this->user=$user;
       $this->language=$user->getCountry();
       $this->conditions=new ConditionsQuery(); 
       $this->settings=CustomerMeetingSettings::load();    
       $this->conditions->setParameters(array('user_id'=>$this->getUser()->getGuardUser()->get('id')));
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
    
    function getSettings()
    {
        return $this->settings;
    }
    
    
         
    function configure()
    {                          
       $this->setDefaults(array(               
            'order'=>array(
                            "in_at"=>"asc",                            
            ), 
            'equal'=>array( 'status'=>'ACTIVE'
            ),
            'range'=>array(                 
            ),
            'nbitemsbypage'=>"10",         
       ));    
         
       $this->setClass('CustomerMeeting');  
       $this->setFields(array('team_id'=>null,                            
                              'state_id'=>array('class'=>'CustomerMeetingStatus','field'=>'id'                                               
                                        ),                                                         
                            ));
       $this->setQuery("SELECT {fields} FROM ".CustomerMeeting::getTable().                      
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('customer_id').                
                       " LEFT JOIN ".CustomerAddress::getInnerForJoin('customer_id'). 
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('telepro_id','telepro'). 
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('sales_id','sale'). 
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('sale2_id','sale2'). 
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('assistant_id','assistant').
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('created_by_id','creator').     
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('state_id').                       
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('campaign_id').
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('callcenter_id').                      
                       " LEFT JOIN ".CustomerMeetingStatusI18n::getInnerForJoin('status_id')." AND ".CustomerMeetingStatusI18n::getTableField('lang')."='{lang}'".
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('status_call_id'). 
                       " LEFT JOIN ".CustomerMeetingStatusCallI18n::getInnerForJoin('status_id')." AND ".CustomerMeetingStatusCallI18n::getTableField('lang')."='{lang}'".
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('status_lead_id'). 
                       " LEFT JOIN ".CustomerMeetingStatusLeadI18n::getInnerForJoin('status_id')." AND ".CustomerMeetingStatusLeadI18n::getTableField('lang')."='{lang}'".
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('type_id'). 
                       " LEFT JOIN ".CustomerMeetingTypeI18n::getInnerForJoin('type_id')." AND ".CustomerMeetingTypeI18n::getTableField('lang')."='{lang}'".
                       " LEFT JOIN ".UserTeamUsers::getTable()." ON ".UserTeamUsers::getTableField('user_id')."=".CustomerMeeting::getTableField('telepro_id').                   
                       " WHERE ". CustomerMeeting::getTableField('id')."!='{meeting_id}' AND ". Customer::getTableField('mobile')."='{mobile}'".
                            $this->conditions->getWhere('AND'). 
                       " GROUP BY ".CustomerMeeting::getTableField('id').
                       ";"); 
     //  echo "Conditions=".$this->conditions->getWhere()."<br/>";
        // Validators        
       $this->setValidators(array( 
                  
            'order' => new mfValidatorSchema(array(                                                    
                                                        "in_at"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                      
                                                       ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(   
                         
                         
                            ),array("required"=>false)),           
            'range' => new mfValidatorSchema(array(                             
                          //    "in_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),   
                          //    "created_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),  
                            ),array("required"=>false)),              
            'equal' => new mfValidatorSchema(array(                              
                              "telepro_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerMeetingUtils::getTeleproUsersForSelect($this->getConditions(),$this->getUser()),"key"=>true,"required"=>false)),          
                              "sales_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerMeetingUtils::getSalesUsersForSelect($this->getConditions(),$this->getUser()),"key"=>true,"required"=>false)),                                           
                              "sale2_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerMeetingUtils::getSalesUsers2ForSelect($this->getConditions(),$this->getUser()),"key"=>true,"required"=>false)),                                           
                              "state_id"=>new mfValidatorChoice(array("choices"=>array(""=>"","IS_NULL"=>__("-- Not affected --"))+CustomerMeetingUtils::getStatusForSelect($this->getLanguage(),$this->getConditions()),"key"=>true,"required"=>false)),
                              "is_confirmed"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>"YES","NO"=>"NO"),"key"=>true,"required"=>false)),                                                                 
                              "status"=>new mfValidatorChoice(array("choices"=>array(""=>"","ACTIVE"=>"ACTIVE","DELETE"=>"DELETE"),"key"=>true,"required"=>false)),                              
                            ),array("required"=>false)),                            
            'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","250"=>"250","500"=>"500","*"=>"*"),"key"=>true)),                    
        ));                                     
         
    }
      
    
     function getConditions()
    {               
        return $this->conditions;
    }
   
      
   /* function setTimeForDate($name)
    {
        if ($this->values['range'][$name]['to'])
        {    
          $this->values['range'][$name]['to'].=" 23:59:59";              
        }
        if ($this->values['range'][$name]['from'])
        {
           $this->values['range'][$name]['from'].=" 00:00:00";    
        }  
    }*/
     
  /*  function getQuery()
    {              
        if ($this->query_valid)
            return $this->query;
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
       return parent::getQuery();
    }   */    
        
    
}

