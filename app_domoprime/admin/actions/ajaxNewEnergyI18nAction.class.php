<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeEnergyNewForm.class.php";

class app_domoprime_ajaxNewEnergyI18nAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
        $form=new LanguageFrontendForm($this->getUser()->getCountry());
        $form->bind($request->getPostParameter('lang'));
        if (!$form->isValid())
        {
            $messages->addError(__("language is not valid."));
            $request->addRequestParameter('lang',$this->getUser()->getCountry());
            $this->forward('app_domoprime','ajaxListPartialEnergy');  
        }       
        $this->form= new DomoprimeEnergyNewForm((string)$form['lang']);
        $this->item_i18n=new DomoprimeEnergyI18n(array('lang'=>(string)$form['lang']));        
    }

}
