<?php

class MutualEngineCalculationMeetingSchedulerBase extends mfObject2 {
    
    protected static $fields=array('meeting_id','date_calculation','is_process','in_process','is_completed','position',
                                   'number_of_results','has_error','error_code',
                                   'is_active','status','created_at','updated_at');
    const table="t_app_mutual_engine_calculation_meeting_scheduler"; 
    protected static $foreignKeys=array('meeting_id'=>'CustomerMeetingMutual',
                                        ); 
    protected static $fieldsNull=array('created_at','updated_at'); // By default
    
    function __construct($parameters=null,$site=null) {
        parent::__construct(null,$site);   
        $this->getDefaults(); 
        if ($parameters === null)  return $this;      
        if (is_array($parameters)||$parameters instanceof ArrayAccess)
        {          
            if (isset($parameters['id']))
               return $this->loadbyId((string)$parameters['id']); 
            return $this->add($parameters); 
        } 
        else
        {
            if (is_numeric((string)$parameters)) 
               return $this->loadbyId((string)$parameters);
        }   
    }
    
    protected function executeLoadById($db)
    {
        $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
           ->makeSiteSqlQuery($this->site);  
    }
    
    protected function getDefaults()
    {
        $this->in_process=isset($this->in_process)?$this->in_process:"NO";
        $this->is_process=isset($this->is_process)?$this->is_process:"NO";
        $this->is_completed=isset($this->is_completed)?$this->is_completed:"NO";
        $this->position=isset($this->position)?$this->position:1;
        $this->number_of_results= isset($this->number_of_results)?$this->number_of_results:0;
        $this->has_error=isset($this->has_error)?$this->has_error:"NO";    
        $this->error_code= isset($this->error_code)?$this->error_code:0;
        $this->date_calculation=isset($this->date_calculation)?$this->date_calculation:date("Y-m-d H:i:s");
        $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
        $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");
        $this->is_active=isset($this->is_active)?$this->is_active:'NO';
        $this->status=isset($this->status)?$this->status:'ACTIVE';
    }
     
    protected function executeInsertQuery($db)
    {
        $db->makeSiteSqlQuery($this->site);   
    }
    
    function getValuesForUpdate()
    {
        $this->set('updated_at',date("Y-m-d H:i:s"));    
    }   
    
    protected function executeUpdateQuery($db)
    {
        $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".self::getKeyName()."=%d ;")
           ->makeSiteSqlQuery($this->site); 
    }
    
    protected function executeDeleteQuery($db)
    {
        $db->setQuery("DELETE FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
           ->makeSiteSqlQuery($this->site);   
    }
    
    protected function executeIsExistQuery($db)    
    {      
//        $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
//        $db->setParameters(array('started_at'=>$this->get('started_at'),'ended_at'=>$this->get('ended_at'),'mutual_product_id'=> $this->get('mutual_product_id'),$this->getKey()))
//           ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE started_at='{started_at}' AND ended_at='{ended_at}' AND mutual_product_id='{mutual_product_id}' ".$key_condition)
//           ->makeSiteSqlQuery($this->site);           
    }
        
    function getDateCalculation()
    {
        return format_date($this->get('date_calculation'),"a");
    }
    
    function getCreatedAt()
    {
        return format_date($this->get('created_at'),"a");
    }
    
    function getUpdatedAt()
    {
        return format_date($this->get('updated_at'),"a");
    }
    
    function hasMeeting()
    {
        return (boolean)$this->get('meeting_id');
    }
    
    public function getMeeting()
    {      
        if (!$this->_meeting_id)
        {
            $this->_meeting_id = new CustomerMeetingMutual($this->get('meeting_id'));          
        }    
        return $this->_meeting_id;
    }
    
    public function setMeeting($meeting)
    {      
        $this->_meeting_id = $meeting;    
        return $this;
    }
    
    function disable()
    {
        if ($this->isNotLoaded())
            return $this;
        $this->set('is_active','NO');
        $this->save();
    }
    
    function enable()
    {
        if ($this->isNotLoaded())
            return $this;
        $this->set('is_active','YES');
        $this->save();
    }
    
    function process()
    {
        $this->initializeSchedulerForProcess();
        $settings = new MutualSettings();
        //1-Initialisation, 
        //2-Recuperer n meeting dans le scheduler
        /*
            SELECT * FROM `t_customers_meeting` 
            INNER JOIN `t_app_mutual_engine_calculation_meeting_scheduler` 
                ON `t_customers_meeting`.id=`t_app_mutual_engine_calculation_meeting_scheduler`.`meeting_id` 
            WHERE `t_app_mutual_engine_calculation_meeting_scheduler`.`in_process`='NO'
                AND `t_app_mutual_engine_calculation_meeting_scheduler`.`is_completed`='NO'
        */
       
        $meetings_schedulers = new MutualEngineCalculationMeetingSchedulerCollection(null, $this->getSite());
        $db=mfSiteDatabase::getInstance()                       
            ->setParameters(array("limit"=>$settings->get('nb_meetings_to_process')))     
            ->setObjects(array('MutualEngineCalculationMeetingScheduler','CustomerMeetingMutual'))
            ->setQuery("SELECT {fields} FROM ". CustomerMeetingMutual::getTable().                         
                       " INNER JOIN ". MutualEngineCalculationMeetingScheduler::getInnerForJoin("meeting_id").
                       " WHERE ".MutualEngineCalculationMeetingScheduler::getTableField("in_process")."='NO'".
                            " AND ".MutualEngineCalculationMeetingScheduler::getTableField("is_completed")."='NO'".
                       " LIMIT 0,{limit}".
                       ";")
            ->makeSiteSqlQuery($this->getSite()); 
        if(!$db->getNumRows())
            return $meetings_schedulers;
        
        while($items = $db->fetchObjects())
        {
            $meeting_scheduler = $items->getMutualEngineCalculationMeetingScheduler();
            $meeting_scheduler->setMeeting($items->getCustomerMeetingMutual());
            $meeting_scheduler->set('in_process','YES');
            $meetings_schedulers[$meeting_scheduler->get('id')]=$meeting_scheduler;
        }
        //save
        $meetings_schedulers->loaded();
        
        $meetings_schedulers->save();
        
        //3-Traiter les meetings
        foreach($meetings_schedulers as $meeting_scheduler)
        {
            $engine_calculation = new AppMutualEngineCore($meeting_scheduler->getMeeting(),$meeting_scheduler->get('date_calculation'));
            $engine_calculation->process();
            $engine_calculation = new MutualEngineCalculationMeeting($engine_calculation);
            $meeting_scheduler->set('is_completed','YES');
            $meeting_scheduler->set('in_process','NO');
            $meetings_schedulers[$meeting_scheduler->get('id')]=$meeting_scheduler;
        }
        $meetings_schedulers->loaded();
        $meetings_schedulers->save();       
    }
    
    function initializeSchedulerForProcess()
    {
        $settings = MutualSettings::load();
        $date_calculation = new DateTime(date("Y-m-d H:i:s"));
        $date_calculation->add(new DateInterval('P'.$settings->get('nb_days_to_add').'D'));
        
        $meetings = CustomerMeetingMutual::getValidMeetingsForCalculation($this->getSite());
        $meetings_schedulers = new MutualEngineCalculationMeetingSchedulerCollection(null, $this->getSite());
        
        foreach($meetings as $meeting)
        {
            $meeting_scheduler = new MutualEngineCalculationMeetingScheduler(array("date_calculation"=>$date_calculation->format('Y-m-d H:i:s')),$this->getSite());
            $meeting_scheduler->set('meeting_id', $meeting->loaded());
            $meetings_schedulers[] = $meeting_scheduler;
        }
        $meetings_schedulers->save();
    }
    
}
