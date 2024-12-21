<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingsFormFilter2.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/CustomerMeetingsPager2.class.php";

class customers_meetings_ajaxListPartialMeeting2Action extends mfAction {

   
        
    function execute(mfWebRequest $request) {        
        $messages = mfMessages::getInstance();          
        $this->user=$this->getUser();
        $this->formFilter= new CustomerMeetingsFormFilter2($this->getUser(),$request->getPostParameter('filter'));        
       // $this->getEventDispather()->notify(new mfEvent($this->formFilter, 'meeting.filter.config'));       
        $this->pager=new CustomerMeetingsPager2($this->formFilter); //$this->formFilter->getObjectsForPager());  
      //  $this->time_init=microtime(true);        
        try
        {        
            
           // var_dump($this->getUser()->getGuardUser()->get('callcenter_id'));
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {    
                   SystemDebug::getInstance()->addMessage($this->formFilter->getQuery());
                 //  SystemDebug::getInstance()->dump($this->getUser()->getCredentials());                   
                
                 //   echo "<!-- ".$this->formFilter->getQuery()." -->"; //"<br/>";
             //  echo $this->formFilter->getQuery()."<br/>";
                  //  trigger_error( $this->formFilter->getQuery());
               // echo $this->formFilter->getQuery()."<br/>"; //" User_id=".$this->getUser()->getGuardUser()->get('id');
                    $this->pager->setQuery($this->formFilter->getQuery());                         
                    $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                    $this->pager->setParameter('lang',$this->getUser()->getCountry()); 
                    $this->pager->setParameter('user_id',$this->getUser()->getGuardUser()->get('id')); 
                    $this->pager->setParameter('callcenter_id',$this->getUser()->getGuardUser()->get('callcenter_id')); 
                    $this->pager->setPage($request->getGetParameter('page'));
                    $this->pager->execute();   
                    // echo "<!-- ".mfSiteDatabase::getInstance()->getQuery()." -->"; //"<br/>";
                   // echo mfSiteDatabase::getInstance()->getQuery()."<br>";
                 //   $this->time_event_start=microtime(true);
                    $this->getEventDispather()->notify(new mfEvent($this->pager, 'meeting.filter.execute'));   
                 //   $this->time_event=microtime(true)-$this->time_event_start;
               }           
               else 
               {
                    $messages->addError(__("Filter has some errors."));
                  //  echo "<!-- "; var_dump($this->formFilter->getErrorSchema()->getErrorsMessage()); echo "-->";
             // echo "<pre>";      var_dump($this->formFilter->getErrorSchema()->getErrorsMessage());  echo "</pre>";
                  // var_dump($this->formFilter['in']->getErrors());                  
               }
        }
        catch (mfException $e)
        {             
            $messages->addError($e);
        }  
        $this->settings_meetings=CustomerMeetingSettings::load();             
    }
    
}    
