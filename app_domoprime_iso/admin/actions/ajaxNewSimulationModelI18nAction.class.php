<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeSimulationModelNewForm.class.php";

class app_domoprime_iso_ajaxNewSimulationModelI18nAction extends mfAction {
    
        
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $form=new LanguageFrontendForm($this->getUser()->getCountry());
        $form->bind($request->getPostParameter('lang'));
        if (!$form->isValid())
        {
            $messages->addError(__("Language is not valid."));
            $request->addRequestParameter('lang',$this->getUser()->getCountry());
            $this->forward('app_domoprime_iso','ajaxListPartialSimulationModel');  
        }       
        $this->form= new DomoprimeSimulationModelNewForm((string)$form['lang'],array());
        $this->item_i18n=new DomoprimeSimulationModelI18n(array('lang'=>(string)$form['lang']));
        $this->country=$this->getUser()->getCountry();
    }

}
