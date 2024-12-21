<?php

require_once dirname(__FILE__)."/../locales/FormFilters/MutualProductFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/MutualProductPager.class.php";

class app_mutual_ajaxListPartialMutualProductAction extends mfAction {
     
    function execute(mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();      
        $this->formFilter = new MutualProductFormFilter();                  
        $this->pager = new MutualProductPager();
        $this->mutual = $request->getRequestParameter("mutual", new MutualPartner($request->getPostParameter("MutualPartner")));
        
        if($this->mutual->isNotLoaded())
        {
            $messages->addError(__("Mutual doesn't existe !"));
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
                $this->pager->setParameter("financial_partner_id",$this->mutual->get('id'));
                $this->pager->execute();              
            }                                    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }         
        
    }
    
}    