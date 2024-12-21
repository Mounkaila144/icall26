<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimePreMeetingModelViewForm.class.php";
 
class app_domoprime_ajaxViewPreMeetingModelI18nAction extends mfAction {
    
    
    
   
        
    function execute(mfWebRequest $request) {                   
        $messages = mfMessages::getInstance();
        $this->form = new DomoprimePreMeetingModelViewForm();
        $this->item_i18n=new DomoprimePreMeetingModelI18n($request->getPostParameter('DomoprimePreMeetingModelI18n'));    
        $this->country=$this->getUser()->getCountry();
   }

}

