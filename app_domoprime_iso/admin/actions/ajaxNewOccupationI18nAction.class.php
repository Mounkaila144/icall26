<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeOccupationNewForm.class.php";

class app_domoprime_iso_ajaxNewOccupationI18nAction extends mfAction {
    
        
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();            
        $form=new LanguageFrontendForm($this->getUser()->getCountry());
        $form->bind($request->getPostParameter('lang'));
        if (!$form->isValid())
        {
            $messages->addError(__("language is not valid."));
            $request->addRequestParameter('lang',$this->getUser()->getCountry());
            $this->forward('app_domoprime_iso','ajaxListPartialOccupation');  
        }       
        $this->form= new DomoprimeOccupationNewForm((string)$form['lang'],array());
        $this->item_i18n=new DomoprimeOccupationI18n(array('lang'=>(string)$form['lang']));        
    }

}
