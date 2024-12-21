<?php


class CustomerMeetingsScheduleRangeFormFilter extends mfFormFilterBase {

    protected $language=null,$user=null,$objects=array(),$calendar=null,$conditions=null,$settings=null;
    
    function __construct($user)
    {                
       $this->user=$user;       
       $this->language=$user->getCountry();      
       $this->conditions=new ConditionsQuery();
       $this->settings=CustomerMeetingSettings::load();
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
      // if ($this->getUser()->hasGroups('telepro'))
       if ($this->getUser()->hasCredential(array(array('filter_meeting_schedule_range_telepro_list')))) 
       {                  
           $this->conditions->setWhere(CustomerMeeting::getTableField('telepro_id')."='{user_id}'");  
           
       }
      // elseif ($this->getUser()->hasGroups('commercial'))
       elseif ($this->getUser()->hasCredential(array(array('filter_meeting_schedule_range_commercial_list'))))  
       {                  
           $this->conditions->setWhere("(".CustomerMeeting::getTableField('sales_id')."={user_id} OR ".
                                       CustomerMeeting::getTableField('sale2_id')."={user_id}".
                                       ")"
                                      );         
       }
      // elseif ($this->getUser()->hasGroups('telepro_manager'))
       elseif ($this->getUser()->hasCredential(array(array('filter_meeting_schedule_range_telepro_manager_list'))))
       {                  
            $this->conditions->setWhere(CustomerMeeting::getTableField('telepro_id')." IN('".$team_users->getKeys()->implode("','")."')"                                       
                                      );   
       } 
       elseif ($this->getUser()->hasCredential(array(array('filter_meeting_schedule_range_sales_manager_list'))))
       {       
            $this->conditions->setWhere(CustomerMeeting::getTableField('telepro_id')." IN('".$team_users->getKeys()->implode("','")."')".
                                       " AND ".CustomerMeeting::getTableField('status')."='ACTIVE'"
                                      );    
       } 
       elseif ($this->getSettings()->hasCallcenter() && $this->getUser()->hasCredential(array(array('filter_meeting_schdule_range_callcenter','filter_meeting_schedule_callcenter_list'))) && $this->getUser()->getGuardUser()->hasCallcenter()) 
       {                               
           $this->conditions->setWhere(CustomerMeeting::getTableField('callcenter_id')."=".$this->getUser()->getGuardUser()->get('callcenter_id').
                                        " AND ".CustomerMeeting::getTableField('status')."='ACTIVE'");           
       } 
       mfContext::getInstance()->getEventManager()->notify(new mfEvent($this, 'meetings.schedule.filter.credentials'));     
       $this->conditions->setParameters(array('user_id'=>$this->getUser()->getGuardUser()->get('id')));       
       $this->setDefaults(array(   
            'date_in'=>date("Y-m-d"),                                
       ));           
       $this->setClass('CustomerMeeting');
       $this->setFields(array('lastname'=>'Customer','postcode'=>'CustomerAddress',
                              'city'=>'CustomerAddress'));
       $this->setQuery("SELECT {fields} FROM ".CustomerMeeting::getTable().                      
                       " INNER JOIN ".CustomerMeeting::getOuterForJoin('customer_id').                
                       " LEFT JOIN ".CustomerAddress::getInnerForJoin('customer_id'). 
                       " INNER JOIN ".CustomerMeeting::getOuterForJoin('opc_range_id').  
                     //  " LEFT JOIN ".CustomerMeeting::getOuterForJoin('telepro_id','telepro'). 
                     //  " LEFT JOIN ".CustomerMeeting::getOuterForJoin('sales_id','sale'). 
                     //  " LEFT JOIN ".CustomerMeeting::getOuterForJoin('assistant_id','assistant').
                     //  " LEFT JOIN ".CustomerMeeting::getOuterForJoin('state_id'). 
                     //  " LEFT JOIN ".CustomerMeeting::getOuterForJoin('campaign_id').
                     //  " LEFT JOIN ".CustomerMeeting::getOuterForJoin('callcenter_id').  
                     //  " LEFT JOIN ".CustomerMeetingStatusI18n::getInnerForJoin('status_id')." AND lang='{lang}'".
                     //  " LEFT JOIN ".CustomerMeeting::getOuterForJoin('status_call_id'). 
                     //  " LEFT JOIN ".CustomerMeetingStatusCallI18n::getInnerForJoin('status_id')." AND ".CustomerMeetingStatusCallI18n::getTableField('lang')."='{lang}'".
                    //   " LEFT JOIN ".CustomerMeeting::getOuterForJoin('status_lead_id'). 
                    //   " LEFT JOIN ".CustomerMeetingStatusLeadI18n::getInnerForJoin('status_id')." AND ".CustomerMeetingStatusLeadI18n::getTableField('lang')."='{lang}'".
                       " WHERE ".CustomerMeeting::getTableField('status')."='ACTIVE' ".
                            " AND in_at >= '{date_in}' AND in_at <= '{date_out}'".                           
                            $this->conditions->getWhere('AND').
                       ";"); 
       // Validators        
       $this->setValidators(array( 
            'date_in' => new mfValidatorI18nDate(array('date_format'=>"a")),
            'action' => new mfValidatorChoice(array('choices'=>array('UP','DOWN'),"required"=>false)),                               
       /*     'order' => new mfValidatorSchema(array(
                                                      //  "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                    
                                                     //   "in_at"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                                                     ///   "lastname"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),     
                                                     //   "postcode"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)), 
                                                     //   "city"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)), 
                                                       ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(   
                          //   "id"=>new mfValidatorString(array("required"=>false)),                            
                          //   "lastname"=>new mfValidatorString(array("required"=>false)),  
                           //  "phone"=>new mfValidatorString(array("required"=>false)),  
                           //  "postcode"=>new mfValidatorString(array("required"=>false)),  
                          //   "city"=>new mfValidatorString(array("required"=>false)),                                               
                            ),array("required"=>false)),                             
            'range' => new mfValidatorSchema(array(                             
                       //       "in_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),   
                            ),array("required"=>false)),    */
            'in'=>new mfValidatorSchema(array( 
                         'telepro_id'=>new mfValidatorChoice(array("choices"=>CustomerMeetingUtils::getTeleproUsers($this->getConditions(),$this->getUser()),'multiple'=>true,'key'=>true,'required'=>false)),                        
                         'sales_id'=>new mfValidatorChoice(array("choices"=>CustomerMeetingUtils::getSalesUsers($this->getConditions(),$this->getUser()),'multiple'=>true,'key'=>true,'required'=>false)),
                         'state_id'=>new mfValidatorChoice(array("choices"=>CustomerMeetingUtils::getStates($this->getLanguage(),$this->getConditions()),'multiple'=>true,"key"=>true,"required"=>false)),
                    ),array("required"=>false)),   
            'begin'=>new mfValidatorSchema(array( 
                     //    'postcode'=> new mfValidatorString(array("required"=>false)),                         
                      "postcode"=>new mfValidatorMultiple(new mfValidatorString(array("required"=>false)),array("required"=>false)),    
                    ),array("required"=>false)), 
           // 'postcode'=> new mfValidatorString(array("required"=>false)),
            'equal' => new mfValidatorSchema(array(     
                            // "is_confirmed"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>"YES","NO"=>"NO"),"key"=>true,"required"=>false)),          
                            //  "telepro_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerMeetingUtils::getTeleproUsersForSelect($this->getSite()),"key"=>true,"required"=>false)),          
                           //   "sales_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerMeetingUtils::getSalesUsersForSelect($this->getSite()),"key"=>true,"required"=>false)),                                           
                          //    "state_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerMeetingUtils::getStatusForSelect($this->getLanguage(), $this->getSite()),"key"=>true,"required"=>false)),
                            ),array("required"=>false)), 
                                
        ));    
       if ($this->getUser()->hasGroups('telepro'))
       {    
           unset($this->in['telepro_id']);
       }   
       if ($this->getSettings()->hasCallcenter() && !$this->getUser()->getGuardUser()->hasCallcenter())
       {          
           $this->in->addValidator('callcenter_id',new mfValidatorChoice(array("choices"=>Callcenter::getCallcenters($this->getConditions()),'multiple'=>true,'key'=>true,'required'=>false)));                              
       } 
       if ($this->getSettings()->hasCampaign())
       {        
           $this->in->addValidator('campaign_id',new mfValidatorChoice(array("choices"=>CustomerMeetingUtils::getCampaigns($this->getConditions()),'multiple'=>true,'key'=>true,'required'=>false)));          
       } 
       if ($this->getSettings()->hasCallStatus())
       {          
          $this->in->addValidator('status_call_id',new mfValidatorChoice(array("choices"=>CustomerMeetingStatusCall::getStatusI18nForSelect($this->getLanguage(),$this->getConditions()),'multiple'=>true,'key'=>true,'required'=>false)));            
          if (($default_status=$this->getSettings()->getStatusCallByDefaultForScheduleFilter()) && $default_status->isLoaded())                     
              $this->defaults['in']['status_call_id']=array($default_status->get('id'));                    
       }
        if ($this->getSettings()->hasLeadStatus())
       {
          $this->equal->addValidator("status_lead_id",new mfValidatorChoice(array("choices"=>array(""=>"","IS_NULL"=>__("-- Not affected --"))+CustomerMeetingUtils::getLeadStatusForSelect($this->getLanguage(),$this->getConditions()),"key"=>true,"required"=>false)));
          $this->in->addValidator('status_lead_id',new mfValidatorChoice(array("choices"=>CustomerMeetingStatusLead::getStatusI18nForSelect($this->getLanguage(),$this->getConditions()),'multiple'=>true,'key'=>true,'required'=>false)));                 
       }
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','meeting_schedule_filter_confirmed')))) 
       {    
        // $this->defaults['in']['is_confirmed']=array('YES');
         $this->in->addValidator('is_confirmed',new mfValidatorChoice(array("choices"=>array(""=>"Nothing","YES"=>"YES","NO"=>"NO"),"key"=>true,'multiple'=>true,"required"=>false)));
       }      
    }
    
              
    
     function execute()
    {                 
       $this->date_in=new Day($this['date_in']->getValue());    
       if ($this['action']->getValue()=='UP')
            $this->date_in=$this->date_in->getDayAdd(7);
        elseif ($this['action']->getValue()=='DOWN')
            $this->date_in=$this->date_in->getDaySub(7);     
       $min=new Time(6);
        $max=new Time(23);                
        $this->calendar=new CalendarRange($this->date_in->getDate(),array("class"=>"DayRangeMeeting",
                                                                      "mode"=>'week',
                                                                     "start_day"=>"monday",
                                                                     "hours"=>array('class'=>'TimeRangeMeeting',
                                                                                    'min'=>$min->getHour(),
                                                                                    'max'=>$max->getHour()
                                                                      )
        ));                               
        $date_end=$this->calendar->getLastDay();     
        $date_start=$this->calendar->getFirstDay();  
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array('date_in'=>$date_start->getDayWithTime($min->getTime()),
                                  'lang'=>$this->getLanguage(),
                                  'user_id'=>$this->getUser()->getGuardUser()->get('id'),
                                  'date_out'=>$date_end->getDayWithTime($max->getTime())))    
            ->setObjects(array('CustomerMeeting','Customer','CustomerAddress'))
          //  ->setAlias($aliases)
            ->setQuery($this->getQuery())
            ->makeSqlQuery();            
     //  echo $db->getQuery();
        $this->number_of_meetings=0;        
        while ($items=$db->fetchObjects())
        {       
            $this->number_of_meetings++;            
            $items->getCustomer()->set('address',$items->getCustomerAddress());
            $items->getCustomerMeeting()->set('customer_id',$items->getCustomer());     
            
            if ($schedule_range=$this->getCalendar()->getDayWithRange($items->getCustomerMeeting()->getInAtDayTime(),$items->getCustomerMeeting()->get('opc_range_id'))) // test if time exists            
                $schedule_range->addMeeting($items->getCustomerMeeting());  
        }                      
    }        
   
    function getCalendar()
    {
        return $this->calendar;
    }
    
    function getNumberOfMeetings()
    {
        return $this->number_of_meetings;
    }
    
    function getDate()
    {
        return format_date($this->date_in->getDate(),"a");
    }
    
     function getConditions()
    {               
        return $this->conditions;
    }
   
     function getSales()
    {       
         return array(""=>new User(null,'admin'))+UserUtils::getUsersByFunctionForSelect('SALES');
    }
    
    
}

