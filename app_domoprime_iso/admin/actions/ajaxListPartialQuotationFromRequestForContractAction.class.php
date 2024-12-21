<?php

require_once dirname(__FILE__)."/../locales/FormFilters/DomoprimeQuotationForContractFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/DomoprimeQuotationForMeetingPager.class.php";

class app_domoprime_iso_ajaxListPartialQuotationFromRequestForContractAction extends mfAction {


    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();   
        $this->user=$this->getUser();       
        $this->contract=$request->getRequestParameter('contract',new CustomerContract($request->getPostParameter('Contract')));
        if ($this->contract->isNotLoaded())
            return ;        
        $this->formFilter= new DomoprimeQuotationForContractFormFilter($this->getUser());                  
        $this->pager=new DomoprimeQuotationForMeetingPager();
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {    
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage("*");
                $this->pager->setParameter('lang',$this->getUser()->getLanguage());    
                $this->pager->setParameter('meeting_id',$this->contract->getMeeting()->get('id'));    
                $this->pager->setParameter('contract_id',$this->contract->get('id')); 
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->execute();  
                $this->getEventDispather()->notify(new mfEvent($this->pager, 'app_domoprime.quotations.pager'));                      
               }                                    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }        
        DomoprimeQuotation::loadNumberOfQuotationsForContract($this->contract);       
    }
    
}    