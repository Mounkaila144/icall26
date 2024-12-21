<?php

require_once dirname(__FILE__)."/../locales/FormFilters/MarketingLeadsWpFormsBySiteFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/MarketingLeadsWpFormsBySitePager.class.php";
 
class marketing_leads_ajaxListRecordsByWpLandingPageSiteAction extends mfAction {
    
    function execute(mfWebRequest $request) { 
        
        $messages = mfMessages::getInstance();

        $this->server = new MarketingLeadsWpLandingPageSite($request->getPostParameter('WpLandingPageSite'),$this->site);
        if ($this->server->isNotLoaded())
            return;
        
        $this->server->register();
        try
        {
            $this->formFilter= new MarketingLeadsWpFormsBySiteFormFilter();
            $this->pager=new MarketingLeadsWpFormsBySitePager();
            $this->formFilter->bind($request->getPostParameter('filter'));
            if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
            {
                $this->pager->setQuery($this->formFilter->getQuery());
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->setSite($this->site);
                $this->pager->executeFromDatabase($this->server->getDatabaseName());
            }
            else
            {
              //  echo "<pre>"; var_dump($this->formFilter->getErrorSchema()->getErrorsMessage()); echo "</pre>";
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
   }

}

