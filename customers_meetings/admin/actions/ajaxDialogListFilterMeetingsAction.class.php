<?php

require_once dirname(__FILE__)."/../locales/FormFilters/DialogListFilterMeetingsFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/DialogListFilterMeetingsPager.class.php";

class customers_meetings_ajaxDialogListFilterMeetingsAction extends mfAction {

     function preExecute()
    {
       $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
      
        
    function execute(mfWebRequest $request) {        
        $messages = mfMessages::getInstance();          
        $this->user=$this->getUser();
        $this->formFilter= new DialogListFilterMeetingsFormFilter($this->getUser());        
        $this->getEventDispather()->notify(new mfEvent($this->formFilter, 'meeting.filter.config'));       
        $this->pager=new DialogListFilterMeetingsPager($this->formFilter->getObjectsForPager());  
      //  $this->time_init=microtime(true);
        try
        {            
           // var_dump($this->getUser()->getGuardUser()->get('callcenter_id'));
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {    
                  // echo "<!-- ".$this->formFilter->getQuery()." -->"; //"<br/>";                 
                    $this->pager->setQuery($this->formFilter->getQuery());                         
                    $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                    $this->pager->setParameter('lang',$this->getUser()->getCountry()); 
                    $this->pager->setParameter('user_id',$this->getUser()->getGuardUser()->get('id')); 
                    $this->pager->setParameter('callcenter_id',$this->getUser()->getGuardUser()->get('callcenter_id')); 
                    $this->pager->setPage($request->getGetParameter('page'));
                    $this->pager->execute();                     
                    $this->getEventDispather()->notify(new mfEvent($this->pager, 'meeting.filter.execute'));               
               }           
               else 
               {
                    $messages->addError(__("Filter has some errors."));
                     var_dump($this->formFilter->getErrorSchema()->getErrorsMessage()); 
               }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }        
    }
    
}    