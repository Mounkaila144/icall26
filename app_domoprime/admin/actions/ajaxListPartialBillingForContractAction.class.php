<?php

require_once dirname(__FILE__)."/../locales/FormFilters/DomoprimeBillingForContractFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/DomoprimeBillingForContractPager.class.php";

class app_domoprime_ajaxListPartialBillingForContractAction extends mfAction {


    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();   
        $this->user=$this->getUser();
        $this->contract=$request->getRequestParameter('contract',new CustomerContract($request->getPostParameter('Contract')));
        if ($this->contract->isNotLoaded())
            return ;
        $this->formFilter= new DomoprimeBillingForContractFormFilter($this->getUser());                  
        $this->pager=new DomoprimeBillingForContractPager();
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {    
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage("*");
                $this->pager->setParameter('lang',$this->getUser()->getLanguage());    
                $this->pager->setParameter('contract_id',$this->contract->get('id'));    
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