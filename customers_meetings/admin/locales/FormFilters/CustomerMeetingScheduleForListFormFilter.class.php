<?php

require_once __DIR__."/CustomerMeetingsFormFilter.class.php";

class CustomerMeetingScheduleForListFormFilter extends CustomerMeetingsFormFilter {
    
    
    function configure() {
        $this->_query->where("in_at >='{date_in}' AND in_at <= '{date_out}'");
        parent::configure();  
        if (!$this->getDefault('date_in'))
            $this->setDefault('date_in',date("Y-m-d"));          
        $this->addValidators(array(
            'date_in' => new mfValidatorI18nDate(array('date_format'=>"a","required"=>false)),
            'action' => new mfValidatorChoice(array('choices'=>array('UP','DOWN'),"required"=>false)),
            'mode' => new mfValidatorChoice(array('required'=>false,'choices'=>array('DAY','WEEK'),'empty_value'=>'WEEK')),
            'view' => new mfValidatorChoice(array('choices'=>array('COMPACT','EXTENDED'),'required'=>false,'empty_value'=>'EXTENDED')),  
        ));   
        $this->setField( 'date_in',array('class'=>'CustomerMeeting','name'=>'in_at'));
    }
    
    
    function getQuery()
    {             
      // $this->values['range']['in_at']=$this->values['date_in'];      
       return parent::getQuery();
    }
    
    function execute()
    {
        $min=new Time(6);
        $max=new Time(23);            
        $this->_date_in=new Day($this['date_in']->getValue()?$this['date_in']->getValue():date("Y-m-d"));    
       
        $mode=$this['mode']->getValue()?strtolower($this['mode']->getValue()):"week";            
        if ($this['action']->getValue()=='UP')
            $this->_date_in=$this->_date_in->getDayAdd(7);
        elseif ($this['action']->getValue()=='DOWN')
            $this->_date_in=$this->_date_in->getDaySub(7);     
       
        $this->calendar=new Calendar($this->_date_in->getDate(),array("class"=>"DayMeeting",
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
                                  'user_id'=>$this->getUser()->getGuardUser()->get('id'),
                                  'date_out'=>$date_end->getDayWithTime($max->getTime())))    
            ->setObjects($this->getObjectsForPager())
            ->setAlias($this->getAlias())
            ->setQuery($this->getQuery())
            ->makeSqlQuery();            
    //   echo $db->getQuery();
      //  echo "<!-- ".$db->getQuery()." -->";
        $this->number_of_meetings=0;
        $meetings=array();
        while ($items=$db->fetchObjects())
        {       
            $this->number_of_meetings++;            
            $items->getCustomerMeeting()->set('customer_id',$items->getCustomer());
            $items->getCustomer()->set('address',$items->getCustomerAddress());
            $items->getCustomerMeeting()->set('callcenter_id',$items->hasCallcenter()?$items->getCallcenter():null);
            $items->getCustomerMeeting()->set('campaign_id',$items->hasCustomerMeetingCampaign()?$items->getCustomerMeetingCampaign():null); 
            $items->getCustomerMeeting()->set('telepro_id',$items->hasTelepro()?$items->getTelepro():null);              
            $items->getCustomerMeeting()->set('sales_id',$items->hasSale()?$items->getSale():null);              
            $items->getCustomerMeeting()->set('sale2_id',$items->hasSale2()?$items->getSale2():null);              
            $items->getCustomerMeeting()->set('assistant_id',$items->hasAssistant()?$items->getAssistant():null);            
            if ($items->hasCustomerMeetingStatus())
            {    
                $items->getCustomerMeetingStatus()->setCustomerMeetingStatusI18n($items->getCustomerMeetingStatusI18n());
                $items->getCustomerMeeting()->set('state_id',$items->getCustomerMeetingStatus());
            }
            else
              $items->getCustomerMeeting()->set('state_id',0);
            
            
            
            if ($schedule_time=$this->getCalendar()->getDayWithTime($items->getCustomerMeeting()->getDayTime())) // test if time exists
            {        
                $schedule_time->addMeeting($items->getCustomerMeeting());
                $meetings[$items->getCustomerMeeting()->get('id')]=$items->getCustomerMeeting();
            }
        }  
        if (empty($meetings))
            return ;              
        // get comments of meetings
        $db=mfSiteDatabase::getInstance();
                 $db->setParameters(array())                
                 ->setQuery("SELECT * FROM ".CustomerMeetingComment::getTable().                           
                            " WHERE ".CustomerMeetingComment::getTableField('meeting_id')." IN(".implode(",",array_keys($meetings)).")".
                            " ORDER BY created_at DESC ".
                            ";")               
                 ->makeSqlQuery(); 
         if (!$db->getNumRows())
             return ;       
           while ($item=$db->fetchObject('CustomerMeetingComment'))
           {                                         
               if (isset($meetings[$item->get('meeting_id')]))
               {    
                 $meetings[$item->get('meeting_id')]->comments[]=$item;               
               }  
           }                   
        
                
        return $this;
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
        return format_date($this->_date_in->getDate(),"a");
    }
    
      function getSales()
    {       
         return array(""=>new User(null,'admin'))+UserUtils::getUsersByFunctionForSelect('SALES');
    }
    
     function getSmSModelsForSaleForSelect()
    {
       return UserModelSmsUtils::getModelSmsForSelect($this->getLanguage()); 
    }
    
     function getEmailModelsForSaleForSelect()
    {
       return UserModelEmailUtils::getModelEmailsForSelect($this->getLanguage()); 
    }
}
