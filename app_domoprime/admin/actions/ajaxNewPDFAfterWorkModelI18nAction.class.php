<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeAfterWorkModelPdfNewForm.class.php";

class app_domoprime_ajaxNewPDFAfterWorkModelI18nAction extends mfAction {
    
        
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();        
        $form=new LanguageFrontendForm($this->getUser()->getCountry(),$this->site);
        $form->bind($request->getPostParameter('lang'));
        if (!$form->isValid())
        {
            $messages->addError(__("language is not valid."));
            $request->addRequestParameter('lang',$this->getUser()->getCountry());
            $this->forward('app_domoprime','ajaxListPartialAfterWorkModel');  
        }       
        $this->form= new DomoprimeAfterWorkModelPdfNewForm((string)$form['lang'],array());
        $this->item_i18n=new DomoprimeAfterWorkModelI18n(array('lang'=>(string)$form['lang']));   
        $this->country=$this->getUser()->getCountry();
    }

}
