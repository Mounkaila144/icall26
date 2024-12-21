<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeEnergyViewForm.class.php";
 
class app_domoprime_ajaxViewEnergyI18nAction extends mfAction {
    
   
    
    
        
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();
        $this->form = new DomoprimeEnergyViewForm();
        $this->item_i18n=new DomoprimeEnergyI18n($request->getPostParameter('DomoprimeEnergyI18n'));        
   }

}

