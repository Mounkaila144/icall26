<?php

require_once dirname(__FILE__)."/../locales/FormFilters/DomoprimeQuotationForContractFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/DomoprimeQuotationForMeetingPager.class.php";


class app_domoprime_iso_quotationsForViewContractActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                
        $this->user=$this->getUser();       
        if (!$this->getUser()->hasCredential(array(array('superadmin','app_domoprime_iso_contract_view_quotations'))))  
                return mfView::NONE; 
        $contract=$this->getParameter('contract');
        if ($contract->isNotLoaded())
             return ;
        $this->formFilter= new DomoprimeQuotationForContractFormFilter($this->user);                  
        $this->pager=new DomoprimeQuotationForMeetingPager();
        try
        {
                $this->formFilter->bind($request->getPostParameter('filter'));                  
                $this->pager->setQuery($this->formFilter->getQuery()); 
                  $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setParameter('lang',$this->user->getLanguage());    
                $this->pager->setParameter('meeting_id',$contract->getMeeting()->get('id'));    
                $this->pager->setParameter('contract_id',$contract->get('id')); 
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->execute();      
                $this->getEventDispather()->notify(new mfEvent($this->pager, 'app_domoprime.quotations.pager')); 
        }
        catch (mfException $e)
        {
            $this->getMessage()->addError($e);
        }        
        DomoprimeQuotation::loadNumberOfQuotationsForContract($contract);   
        $this->last_quotation=new DomoprimeQuotation($contract);
    } 
    
    
}