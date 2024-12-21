<?php

require_once dirname(__FILE__)."/../locales/FormFilters/MarketingLeadsWpFormsFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/MarketingLeadsWpFormsPager.class.php";

class marketing_leads_ajaxListPartialWpFormsAction extends mfAction {
    
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();     
        $this->formFilter= new MarketingLeadsWpFormsFormFilter();                  
        $this->pager=new MarketingLeadsWpFormsPager();
        $this->landing_page_site = $request->getRequestParameter("site",new MarketingLeadsWpLandingPageSite($request->getPostParameter("WpLandingPageSite")));
        
        if($this->landing_page_site->isNotLoaded())
        {
            $messages->addError(__('Site not loaded.'));
            $this->forward("marketing_leads", "ajaxListPartialWpLandingPageSite");
        }
        try
        {
            $this->formFilter->bind($request->getPostParameter('filter'));
            if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
            {    
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);            
                $this->pager->setParameter('site_id', $this->landing_page_site->get('id'));
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