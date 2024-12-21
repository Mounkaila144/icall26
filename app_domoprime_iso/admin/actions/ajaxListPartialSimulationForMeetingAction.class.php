<?php

require_once dirname(__FILE__)."/../locales/FormFilters/DomoprimeSimulationForMeetingFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/DomoprimeSimulationForMeetingPager.class.php";

class app_domoprime_iso_ajaxListPartialSimulationForMeetingAction extends mfAction {


    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();   
        $this->user=$this->getUser();
        $this->meeting=$request->getRequestParameter('meeting',new CustomerMeeting($request->getPostParameter('Meeting')));
        if ($this->meeting->isNotLoaded())
            return ;
        $this->formFilter= new DomoprimeSimulationForMeetingFormFilter($this->getUser());                  
        $this->pager=new DomoprimeSimulationForMeetingPager();
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {    
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage("*");
                $this->pager->setParameter('lang',$this->getUser()->getLanguage());    
                $this->pager->setParameter('meeting_id',$this->meeting->get('id'));    
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->execute();              
               }                                    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        } 
      //  DomoprimeQuotation::loadNumberOfQuotationsForMeeting($this->meeting);
       // var_dump($this->pager[0]);
    }
    
}    