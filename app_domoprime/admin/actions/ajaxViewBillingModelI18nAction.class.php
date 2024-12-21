<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeBillingModelViewForm.class.php";
 
class app_domoprime_ajaxViewBillingModelI18nAction extends mfAction {
    
    
    
   
        
    function execute(mfWebRequest $request) {                   
        $messages = mfMessages::getInstance();
        $this->form = new DomoprimeBillingModelViewForm();
        $this->item_i18n=new DomoprimeBillingModelI18n($request->getPostParameter('DomoprimeBillingModelI18n'));    
        $this->country=$this->getUser()->getCountry();
   }

}

