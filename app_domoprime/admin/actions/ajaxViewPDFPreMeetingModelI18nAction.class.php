<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimePreMeetingModelPdfViewForm.class.php";
 
class app_domoprime_ajaxViewPDFPreMeetingModelI18nAction extends mfAction {
    
           
        
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();
        $this->form = new DomoprimePreMeetingModelPdfViewForm();
        $this->item_i18n=new DomoprimePreMeetingModelI18n($request->getPostParameter('PreMeetingModelI18n'));    
        $this->user=$this->getUser();                 
   }

}

