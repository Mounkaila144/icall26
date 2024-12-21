<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeQuotationModelViewForm.class.php";
 
class app_domoprime_ajaxViewQuotationModelI18nAction extends mfAction {
    
    
    
   
        
    function execute(mfWebRequest $request) {                   
        $messages = mfMessages::getInstance();
        $this->form = new DomoprimeQuotationModelViewForm();
        $this->item_i18n=new DomoprimeQuotationModelI18n($request->getPostParameter('DomoprimeQuotationModelI18n'));    
        $this->country=$this->getUser()->getCountry();
   }

}

