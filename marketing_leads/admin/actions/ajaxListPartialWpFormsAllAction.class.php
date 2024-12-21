<?php

require_once dirname(__FILE__)."/../locales/FormFilters/MarketingLeadsWpFormsAllFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/MarketingLeadsWpFormsAllPager.class.php";

class marketing_leads_ajaxListPartialWpFormsAllAction extends mfAction {
    
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();     
        $this->formFilter = new MarketingLeadsWpFormsAllFormFilter();                  
        $this->pager = new MarketingLeadsWpFormsAllPager();
        $this->user = $this->getUser();
        try
        {
            $this->formFilter->bind($request->getPostParameter('filter'));
            if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
            {    
//                echo $this->formFilter->getQuery();
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);            
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->execute();  
            }    
            else
            {
//                echo "<pre>"; var_dump($this->formFilter->getErrorSchema()->getErrorsMessage()); echo "</pre>";
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }         
    }
    
}    