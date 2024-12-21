<?php

require_once dirname(__FILE__)."/../locales/FormFilters/DomoprimeQuotationForMeetingFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/DomoprimeQuotationForMeetingPager.class.php";

class app_domoprime_iso_ajaxListPartialQuotationFromRequestForViewMeetingAction extends mfAction {


    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();   
        $this->user=$this->getUser();
        $this->meeting=$request->getRequestParameter('meeting',new CustomerMeeting($request->getPostParameter('Meeting')));
        if ($this->meeting->isNotLoaded())
            return ;      
        $this->formFilter= new DomoprimeQuotationForMeetingFormFilter($this->getUser());                  
        $this->pager=new DomoprimeQuotationForMeetingPager();
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
                $this->getEventDispather()->notify(new mfEvent($this->pager, 'app_domoprime.quotations.pager')); 
               }                                    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        } 
        DomoprimeQuotation::loadNumberOfQuotationsForMeeting($this->meeting);
        $this->last_quotation=new DomoprimeQuotation($this->meeting);
    }
}    