<?php

require_once dirname(__FILE__).'/../locales/Forms/DomoprimePolluterClassPricingViewForm.class.php';

class app_domoprime_ajaxViewPricingForPolluterAction extends mfAction{
    
    function execute(mfWebRequest $request){
        
        $messages = mfMessages::getInstance();           
       $this->item = new DomoprimePolluterClassPricing($request->getPostParameter('PolluterClassPricing'));         
       $this->form = new DomoprimePolluterClassPricingViewForm($this->getUser());           
    }
}
