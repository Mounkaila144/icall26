<?php

require_once dirname(__FILE__)."/../locales/Forms/MarketingLeadsWpFormsStatusViewForm.class.php";
 
class marketing_leads_ajaxViewStatusI18nAction extends mfAction {
    
    function preExecute()
    {
       $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
    
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();
        $this->form = new MarketingLeadsWpFormsStatusViewForm();
        $this->item = new MarketingLeadsWpFormsStatusI18n($request->getPostParameter('MarketingLeadsStatusI18n'));        
    }
}

