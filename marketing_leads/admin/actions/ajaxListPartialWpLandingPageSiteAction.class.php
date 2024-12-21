<?php

require_once dirname(__FILE__)."/../locales/FormFilters/MarketingLeadsWpLandingPageSiteFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/MarketingLeadsWpLandingPageSitePager.class.php";

class marketing_leads_ajaxListPartialWpLandingPageSiteAction extends mfAction {
    
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();     
        $this->user = $this->getUser();
        $this->formFilter= new MarketingLeadsWpLandingPageSiteFormFilter();                  
        $this->pager=new MarketingLeadsWpLandingPageSitePager();
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