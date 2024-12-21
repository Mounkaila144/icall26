<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeAfterWorkModelViewForm.class.php";
 
class app_domoprime_ajaxViewAfterWorkModelI18nAction extends mfAction {
    
    
    
   
        
    function execute(mfWebRequest $request) {                   
        $messages = mfMessages::getInstance();
        $this->form = new DomoprimeAfterWorkModelViewForm();
        $this->item_i18n=new DomoprimeAfterWorkModelI18n($request->getPostParameter('DomoprimeAfterWorkModelI18n'));    
        $this->country=$this->getUser()->getCountry();
   }

}

