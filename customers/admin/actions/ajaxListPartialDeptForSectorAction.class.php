<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerSectorDeptForSectorFormFilter.class.php";

class customers_ajaxListPartialDeptForSectorAction extends mfAction {


   
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();  
        $this->item = new CustomerSector($request->getPostParameter('CustomerSector')); 
        var_dump($this->item->get('id'));
        if ($this->item->isNotLoaded()) 
            return ;
        $this->formFilter= new CustomerSectorDeptForSectorFormFilter();                  
        $this->pager=new Pager('CustomerSectorDept');
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {    
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);                             
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->execute();              
               }                                    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }         
         
    }
    
}    