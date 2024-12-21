<?php


class CustomerMeetingsImportFormFilter extends mfFormFilterBase {

    protected $site=null,$language=null,$user=null,$count=0,$next_limit=0,$is_finished=false,$settings=null;
    
    function __construct($user,$defaults=array(),$site=null)
    {                
       $this->site=$site; 
       $this->user=$user;
       $this->language=$user->getCountry();   
       $this->settings=CustomerMeetingImportSettings::load($site);
       parent::__construct($defaults);      
    }        
    
    function getLanguage()
    {
      return $this->language;    
    }
    
    function getSite()
    {
     return $this->site;
    }
    
    function getSettings()
    {
        return $this->settings;
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    
    function configure()
    {       
       if (!$this->hasDefaults())
           $this->setDefaults(array('limit'=>0));       
       $this->setClass('CustomerMeeting');       
       $this->setFields(array());
       $this->setQuery("SELECT {fields} FROM ".CustomerMeeting::getTable().                      
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('customer_id').                
                       " LEFT JOIN ".CustomerAddress::getInnerForJoin('customer_id'). 
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('telepro_id','telepro'). 
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('sales_id','sale1'). 
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('sale2_id','sale2'). 
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('assistant_id','assistant').
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('created_by_id','creator').     
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('state_id').   
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('campaign_id').
                       " LEFT JOIN ".CustomerMeetingStatusI18n::getInnerForJoin('status_id')." AND ".CustomerMeetingStatusI18n::getTableField('lang')."='{lang}'".
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('status_call_id'). 
                       " LEFT JOIN ".CustomerMeetingStatusCallI18n::getInnerForJoin('status_id')." AND ".CustomerMeetingStatusCallI18n::getTableField('lang')."='{lang}'".
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('status_lead_id'). 
                       " LEFT JOIN ".CustomerMeetingStatusLeadI18n::getInnerForJoin('status_id')." AND ".CustomerMeetingStatusLeadI18n::getTableField('lang')."='{lang}'".
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('type_id'). 
                       " LEFT JOIN ".CustomerMeetingTypeI18n::getInnerForJoin('type_id')." AND ".CustomerMeetingTypeI18n::getTableField('lang')."='{lang}'".                       
                       " WHERE ". CustomerMeeting::getTableField('status')."='ACTIVE'".                      
                       ";"); 
       // Validators        
       $this->setValidators(array( 
               'range' => new mfValidatorSchema(array(                             
                              "creation_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                                                             
                            ),array("required"=>false)),                            
               "limit"=>new mfValidatorInteger(array('min'=>0,'required'=>false,'empty_value'=>0)),
               "site_id"=>new ObjectExistsValidator('Site',array('key'=>false))                   
        ));    
       
      
    }
    
    function getCount()
    {   
       if (!$this->count)
       {    
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery(strtr($this->getQuery(),array('{fields}'=>"count(".CustomerMeeting::getTableField('id').")")))               
                ->makeSiteSqlQuery($this->getSiteSource()); 
        $row=$db->fetchRow();
        $this->count= $row[0];
       } 
       return $this->count;
    }
   
    
    function execute()
    {       
        $this->next_limit=$this['limit']->getValue() + $this->getSettings()->get('number_of_items',10);        
        if ($this->getCount() <  $this->next_limit)
        {                
            $this->next_limit=$this->getCount();
            $this->is_finished=true;
        }    
        $this->progress=$this->next_limit;        
        $this->meetings=new CustomerMeetingCollection(null,$this->getSiteSource());        
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setObjects(array('CustomerMeeting',
                                   'telepro'=>'User',
                                   'sale1'=>'User','sale2'=>'User',
                                   'assistant'=>'User','creator'=>'User',
                                   'Customer','CustomerMeetingCampaign',
                                   'CustomerMeetingStatusCall','CustomerMeetingStatusCallI18n',
                                   'CustomerMeetingStatus','CustomerMeetingStatusI18n',
                                   'CustomerMeetingStatusLead','CustomerMeetingStatusLeadI18n',
                                   'CustomerAddress'))
                ->setAlias(array('telepro'=>'telepro','assistant'=>'assistant','creator'=>'creator',
                                 'sale1'=>'sale1','sale2'=>'sale2'))                
                ->setQuery(str_replace(";"," LIMIT ".$this['limit']->getValue().",".$this->getSettings()->get('number_of_items',10),$this->getQuery()))
                ->makeSiteSqlQuery($this->getSiteSource()); 
          if (!$db->getNumRows())
             return $this;                
        while ($items=$db->fetchObjects())
        {                      
              $item=$items->getCustomerMeeting();
              if ($items->hasCustomerMeetingStatusI18n())
                  $items->getCustomerMeetingStatus()->setCustomerMeetingStatusI18n($items->getCustomerMeetingStatusI18n()); 
              if ($items->hasCustomerMeetingStatusCallI18n() && $items->hasCustomerMeetingStatusCall())
                  $items->getCustomerMeetingStatusCall()->setI18n($items->getCustomerMeetingStatusCallI18n()); 
              if ($items->hasCustomerMeetingTypeI18n() && $items->hasCustomerMeetingType())
                  $items->getCustomerMeetingType()->setI18n($items->getCustomerMeetingTypeI18n());               
              $item->set('telepro_id',$items->hasTelepro()?$items->getTelepro():null);              
              $item->set('sales_id',$items->hasSale()?$items->getSale():null);              
              $item->set('sale2_id',$items->hasSale2()?$items->getSale2():null);              
              $item->set('assistant_id',$items->hasAssistant()?$items->getAssistant():null);
              $item->set('created_by_id',$items->hasCreator()?$items->getCreator():null);
              $item->set('callcenter_id',$items->hasCallcenter()?$items->getCallcenter():null);
              $item->set('campaign_id',$items->hasCustomerMeetingCampaign()?$items->getCustomerMeetingCampaign():null);
              $item->set('state_id',$items->hasCustomerMeetingStatus()?$items->getCustomerMeetingStatus():null); 
              $item->set('status_call_id',$items->hasCustomerMeetingStatusCall()?$items->getCustomerMeetingStatusCall():null);
              $item->set('status_lead_id',$items->hasCustomerMeetingStatusLead()?$items->getCustomerMeetingStatusLead():null); 
              $item->set('type_id',$items->hasCustomerMeetingType()?$items->getCustomerMeetingType():null); 
              $items->getCustomer()->set('address',$items->getCustomerAddress());
              $item->set('customer_id',$items->getCustomer());             
              $this->meetings[]=$item;
        }     
        $this->meetings->copyToSite($this->getSite());
    }
    
    function getNextLimit()
    {
        return $this->next_limit;
    }
    
    function getProgressBar()
    {        
       return  $this->progress / $this->getCount();
    }
    
    function getProgressBarPourcentage()
    {        
       return format_number(($this->progress / $this->getCount() * 100),"##")." %";
    }
    
     function getProgressBarRemaining()
    {        
       return  $this->progress."/". $this->getCount();
    }
    
    function isFinished()
    {
        return $this->is_finished; 
    }
    
    function getSiteSource()
    {
        return $this['site_id']->getValue();
    }
    
    function isProcessed()
    {
        return !$this->isFinished();
    }
    
    function getMeetings()
    {
        return $this->meetings;
    }
}

