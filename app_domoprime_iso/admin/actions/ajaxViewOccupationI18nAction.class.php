<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeOccupationViewForm.class.php";
 
class app_domoprime_iso_ajaxViewOccupationI18nAction extends mfAction {
    
  
        
    function execute(mfWebRequest $request) {              
     
        $messages = mfMessages::getInstance();
        $this->form = new DomoprimeOccupationViewForm();
        $this->item_i18n=new DomoprimeOccupationI18n($request->getPostParameter('DomoprimeOccupationI18n'));        
   }

}

