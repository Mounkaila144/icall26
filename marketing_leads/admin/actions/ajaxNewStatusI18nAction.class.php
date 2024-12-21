<?php

require_once dirname(__FILE__)."/../locales/Forms/MarketingLeadsWpFormsStatusNewForm.class.php";

class marketing_leads_ajaxNewStatusI18nAction extends mfAction {
    
    function preExecute()
    {
       $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
    
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
        $form=new LanguageFrontendForm($this->getUser()->getCountry());
        $form->bind($request->getPostParameter('lang'));
        if (!$form->isValid())
        {
            $messages->addError(__("language is not valid."));
            $request->addRequestParameter('lang',$this->getUser()->getCountry());
            $this->forward('marketing_leads','ajaxListPartialStatus');  
        }       
        $this->form= new MarketingLeadsWpFormsStatusNewForm((string)$form['lang']);
        $this->status_i18n=new MarketingLeadsWpFormsStatusI18n(array('lang'=>(string)$form['lang']));        
    }

}
