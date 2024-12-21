<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerUserForCompanyFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/CustomerUserForCompanyPager.class.php";

class customers_ajaxListPartialUserForCompanyAction extends mfAction {
    
       
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();   
        if (!$this->getUser()->isAuthenticated() || !$this->getUser()->isCustomerUser())             
              $this->forwardTo401Action();
        $this->user=$this->getUser();      
        $this->formFilter= new CustomerUserForCompanyFormFilter($this->user);                  
        $this->pager=new CustomerUserForCompanyPager();
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {  
                
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);  
                $this->pager->setParameter('company_id',$this->user->getGuardUser()->getCompany()->get('id'));
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