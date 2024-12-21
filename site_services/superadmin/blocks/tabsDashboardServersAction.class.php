<?php

require_once dirname(__FILE__).'/../locales/FormFilters/SiteServicesSiteFormFiter.class.php';
require_once dirname(__FILE__).'/../locales/Pagers/SiteServicesSitePager.class.php';

class site_services_tabsDashboardServersActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                               
        $this->user=$this->getUser();
        $this->formFilter= new SiteServicesSiteFormFiter();                  
        $this->pager=new SiteServicesSitePager();
        try
       {                     
                    $this->pager->setQuery($this->formFilter->getQuery()); 
                    $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);                 
                    $this->pager->setPage($request->getGetParameter('page'));
                    $this->pager->execute();                
        }
        catch (mfException $e)
        {          
            $this->getMessage()->addError($e);
        } 
        $this->settings=SiteServicesSettings::load();   
    } 
    
    
}