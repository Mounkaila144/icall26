<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeTypeLayerNewForm.class.php";

class app_domoprime_iso_ajaxNewTypeLayerI18nAction extends mfAction {
    
        
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();            
        $form=new LanguageFrontendForm($this->getUser()->getCountry());
        $form->bind($request->getPostParameter('lang'));
        if (!$form->isValid())
        {
            $messages->addError(__("Language is not valid."));
            $request->addRequestParameter('lang',$this->getUser()->getCountry());
            $this->forward('app_domoprime_iso','ajaxListPartialTypeLayer');  
        }       
        $this->form= new DomoprimeTypeLayerNewForm((string)$form['lang'],array());
        $this->item_i18n=new DomoprimeTypeLayerI18n(array('lang'=>(string)$form['lang']));        
    }

}
