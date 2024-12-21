<?php


class CustomerMeetingsScheduleFormFilter extends mfFormFilterBase {

    protected $site=null,$language=null,$objects=array(),$calendar=null,$conditions=null;
    
    function __construct($language,$site=null)
    {                
       $this->site=$site; 
       $this->language=$language;   
       $this->conditions=new ConditionsQuery();
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
    
    function configure()
    {               
       $this->objects=array('CustomerMeeting',
                            'Customer','CustomerAddress',
                            'CustomerMeetingStatus',
                            'CustomerMeetingStatusI18n',
                            'telepro'=>'User','sale'=>'User'
           ); 
       $this->setDefaults(array(   
            'date_in'=>date("Y-m-d"),              
            'mode'=>'WEEK'
       ));          
       $this->setClass('CustomerMeeting');
       $this->setFields(array('lastname'=>'Customer','postcode'=>'CustomerAddress','city'=>'CustomerAddress'));
       $this->setQuery("SELECT {fields} FROM ".CustomerMeeting::getTable().                      
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('customer_id').                
                       " LEFT JOIN ".CustomerAddress::getInnerForJoin('customer_id'). 
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('telepro_id','telepro'). 
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('sales_id','sale'). 
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('state_id'). 
                       " LEFT JOIN ".CustomerMeetingStatusI18n::getInnerForJoin('status_id')." AND lang='{lang}'".
                       " WHERE ".CustomerMeeting::getTableField('status')."='ACTIVE' AND in_at >= '{date_in}' AND in_at <= '{date_out}'".
                       ";"); 
       // Validators        
       $this->setValidators(array( 
            'date_in' => new mfValidatorI18nDate(array('date_format'=>"a")),
            'action' => new mfValidatorChoice(array('choices'=>array('UP','DOWN'),"required"=>false)),
            'mode' => new mfValidatorChoice(array('choices'=>array('DAY','WEEK'))),
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
                         'telepro_id'=>new mfValidatorChoice(array("choices"=>CustomerMeetingUtils::getTeleproUsers($this->getConditions(),$this->getSite()),'multiple'=>true,'key'=>true,'required'=>false)),
                         'sales_id'=>new mfValidatorChoice(array("choices"=>CustomerMeetingUtils::getSalesUsers($this->getConditions(),$this->getSite()),'multiple'=>true,'key'=>true,'required'=>false)),
                         'state_id'=>new mfValidatorChoice(array("choices"=>CustomerMeetingUtils::getStates($this->getLanguage(),$this->getConditions(), $this->getSite()),'multiple'=>true,"key"=>true,"required"=>false)),
                    ),array("required"=>false)),   
            'equal' => new mfValidatorSchema(array(     
                            // "is_confirmed"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>"YES","NO"=>"NO"),"key"=>true,"required"=>false)),          
                            //  "telepro_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerMeetingUtils::getTeleproUsersForSelect($this->getSite()),"key"=>true,"required"=>false)),          
                           //   "sales_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerMeetingUtils::getSalesUsersForSelect($this->getSite()),"key"=>true,"required"=>false)),                                           
                          //    "state_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerMeetingUtils::getStatusForSelect($this->getLanguage(), $this->getSite()),"key"=>true,"required"=>false)),
                            ),array("required"=>false)), 
                                
        ));    
               
    }
    
    function getObjectsForPager()
    {
        return $this->objects;
    }            
    
     function execute()
    {           
        $min=new Time(6);
        $max=new Time(23);
        $this->date_in=new Day($this['date_in']->getValue());      
        $mode=strtolower($this['mode']->getValue());            
        if ($this['action']->getValue()=='UP')
            $this->date_in=$this->date_in->getDayAdd(7);
        elseif ($this['action']->getValue()=='DOWN')
            $this->date_in=$this->date_in->getDaySub(7);     
        $this->calendar=new Calendar($this->date_in->getDate(),array("class"=>"DayMeeting",
                                                                     "mode"=>$mode,
                                                                     "start_day"=>"monday",
                                                                     "hours"=>array('class'=>'TimeMeeting',
                                                                                    'min'=>$min->getHour(),
                                                                                    'max'=>$max->getHour()
                                                                      )
        ));                               
        $date_end=$this->calendar->getLastDay();     
        $date_start=$this->calendar->getFirstDay();
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array('date_in'=>$date_start->getDayWithTime($min->getTime()),
                                  'lang'=>$this->getLanguage(),
                                  'date_out'=>$date_end->getDayWithTime($max->getTime())))    
            ->setObjects($this->getObjectsForPager())
            ->setAlias(array('telepro'=>'telepro','sale'=>'sale'))
            ->setQuery($this->getQuery())
            ->makeSiteSqlQuery($this->getSite());            
        $this->number_of_meetings=0;       
        while ($item=$db->fetchObjects())
        {       
            $this->number_of_meetings++;
            $item->getCustomer()->set('address',$item->getCustomerAddress());
            $item->getCustomerMeeting()->set('customer_id',$item->getCustomer());
            if ($item->hasCustomerMeetingStatus())
            {
                $item->getCustomerMeetingStatus()->setCustomerMeetingStatusI18n($item->getCustomerMeetingStatusI18n());
                $item->getCustomerMeeting()->set('state_id',$item->getCustomerMeetingStatus());        
            }
            else $item->getCustomerMeeting()->set('state_id',0);
            if ($schedule_time=$this->getCalendar()->getDayWithTime($item->getCustomerMeeting()->getDayTime())) // test if time exists
                $schedule_time->addMeeting($item->getCustomerMeeting());
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
      
}

