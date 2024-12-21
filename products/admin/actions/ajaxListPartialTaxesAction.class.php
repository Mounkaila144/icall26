<?php

require_once dirname(__FILE__)."/../locales/FormFilters/TaxesFormFilter.class.php";

class products_ajaxListPartialTaxesAction extends mfAction {


    
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();    
        $this->formFilter= new TaxesFormFilter();
        $this->pager=new Pager('Tax');
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