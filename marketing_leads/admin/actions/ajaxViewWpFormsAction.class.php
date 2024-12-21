<?php

require_once dirname(__FILE__)."/../locales/Forms/MarketingLeadsWpFormsViewForm.class.php";
 
class marketing_leads_ajaxViewWpFormsAction extends mfAction {
        
    function execute(mfWebRequest $request) {              
     
        $messages = mfMessages::getInstance();
        $this->form = new MarketingLeadsWpFormsViewForm();
        $this->item=new MarketingLeadsWpForms($request->getPostParameter('WpForms')); 
        $this->landing_page_site = $request->getRequestParameter("site",new MarketingLeadsWpLandingPageSite($request->getPostParameter("WpLandingPageSite")));
        
        if($this->landing_page_site->isNotLoaded())
        {
            $messages->addError(__('Site not loaded.'));
            $this->forward("marketing_leads", "ajaxListPartialWpLandingPageSite");
        }
    }

}

