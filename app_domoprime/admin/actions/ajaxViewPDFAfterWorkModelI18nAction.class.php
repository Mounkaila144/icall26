<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeAfterWorkModelPdfViewForm.class.php";
 
class app_domoprime_ajaxViewPDFAfterWorkModelI18nAction extends mfAction {
    
           
        
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();
        $this->form = new DomoprimeAfterWorkModelPdfViewForm();
        $this->item_i18n=new DomoprimeAfterWorkModelI18n($request->getPostParameter('AfterWorkModelI18n'));    
        $this->user=$this->getUser();        
   }

}

