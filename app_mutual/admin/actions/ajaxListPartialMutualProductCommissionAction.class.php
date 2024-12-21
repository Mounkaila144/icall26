<?php

require_once dirname(__FILE__)."/../locales/FormFilters/MutualProductCommissionFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/MutualProductCommissionPager.class.php";

class app_mutual_ajaxListPartialMutualProductCommissionAction extends mfAction {
    
    function execute(mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();      
        $this->formFilter = new MutualProductCommissionFormFilter();                  
        $this->pager = new MutualProductCommissionPager();
        $this->product = $request->getRequestParameter("product", new MutualProduct($request->getPostParameter("MutualProduct")));
        
        if($this->product->isNotLoaded())
        {
            $messages->addError(__("Mutual product doesn't existe !"));
            $this->forward("app_mutual","ajaxListPartialMutualPartner");
        }
        
        try
        {
            $this->formFilter->bind($request->getPostParameter('filter'));
            if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
            {    
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);                             
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->setParameter("mutual_product_id",$this->product->get('id'));
                $this->pager->execute();              
            }                                    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }         
        
    }
    
}    