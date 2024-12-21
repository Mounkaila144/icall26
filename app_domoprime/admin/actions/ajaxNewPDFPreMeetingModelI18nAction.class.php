<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimePreMeetingModelPdfNewForm.class.php";

class app_domoprime_ajaxNewPDFPreMeetingModelI18nAction extends mfAction {
    
        
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();        
        $form=new LanguageFrontendForm($this->getUser()->getCountry(),$this->site);
        $form->bind($request->getPostParameter('lang'));
        if (!$form->isValid())
        {
            $messages->addError(__("language is not valid."));
            $request->addRequestParameter('lang',$this->getUser()->getCountry());
            $this->forward('app_domoprime','ajaxListPartialPreMeetingModel');  
        }       
        $this->form= new DomoprimePreMeetingModelPdfNewForm((string)$form['lang'],array());
        $this->item_i18n=new DomoprimePreMeetingModelI18n(array('lang'=>(string)$form['lang']));   
        $this->country=$this->getUser()->getCountry();
    }

}
