<?php

require_once dirname(__FILE__)."/../locales/FormFilters/DomoprimeCalculationForMeetingFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/DomoprimeCalculationForMeetingPager.class.php";

class app_domoprime_ajaxListPartialRequestForMeetingAction extends mfAction {

 
   
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();       
        $this->meeting=new CustomerMeeting($request->getPostParameter('Meeting'));       
        if ($this->meeting->isNotLoaded())
            return ;
        
        $this->formFilter= new DomoprimeCalculationForMeetingFormFilter();                  
        $this->pager=new DomoprimeCalculationForMeetingPager();
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {    
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setParameter('lang',$this->getUser()->getCountry()); 
                $this->pager->setParameter('meeting_id',$this->meeting->get('id'));
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->execute();              
               }                                    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }         
       // var_dump($this->pager[0]);
    }
    
}    