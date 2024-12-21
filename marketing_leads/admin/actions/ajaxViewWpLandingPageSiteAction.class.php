<?php

require_once dirname(__FILE__)."/../locales/Forms/MarketingLeadsWpLandingPageSiteViewForm.class.php";
 
class marketing_leads_ajaxViewWpLandingPageSiteAction extends mfAction {
        
    function execute(mfWebRequest $request) {              
     
        $messages = mfMessages::getInstance();
        $this->form = new MarketingLeadsWpLandingPageSiteViewForm();
        $this->item=new MarketingLeadsWpLandingPageSite($request->getPostParameter('WpLandingPageSite'));        
    }

}

