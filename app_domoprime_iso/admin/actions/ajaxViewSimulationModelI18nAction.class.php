<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeSimulationModelViewForm.class.php";
 
class app_domoprime_iso_ajaxViewSimulationModelI18nAction extends mfAction {
    
    
    
   
        
    function execute(mfWebRequest $request) {                   
        $messages = mfMessages::getInstance();
        $this->form = new DomoprimeSimulationModelViewForm();
        $this->item_i18n=new DomoprimeSimulationModelI18n($request->getPostParameter('DomoprimeSimulationModelI18n'));    
        $this->country=$this->getUser()->getCountry();
   }

}

