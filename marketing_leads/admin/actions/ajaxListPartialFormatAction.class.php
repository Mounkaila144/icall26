<?php

require_once dirname(__FILE__)."/../locales/FormFilters/MarketingLeadsWpFormsLeadsImportFormatFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/MarketingLeadsWpFormsLeadsImportFormatPager.class.php";

class marketing_leads_ajaxListPartialFormatAction extends mfAction {
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();       
        $this->formFilter= new MarketingLeadsWpFormsLeadsImportFormatFormFilter();                  
        $this->pager=new MarketingLeadsWpFormsLeadsImportFormatPager();
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

