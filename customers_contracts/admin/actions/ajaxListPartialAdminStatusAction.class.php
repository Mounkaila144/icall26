<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomersContractAdminStatusFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/CustomersContractAdminStatusPager.class.php";

class customers_contracts_ajaxListPartialAdminStatusAction extends mfAction {


    
   
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();     
        $this->formFilter= new CustomersContractAdminStatusFormFilter($request->getRequestParameter('lang',$request->getPostParameter('lang',$this->getUser()->getCountry())));                  
        $this->pager=new CustomersContractAdminStatusPager();
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {    
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setParameter('lang',(string)$this->formFilter['lang']);                
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