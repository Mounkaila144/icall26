<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeTypeLayerViewForm.class.php";
 
class app_domoprime_iso_ajaxViewTypeLayerI18nAction extends mfAction {
    
  
        
    function execute(mfWebRequest $request) {              
     
        $messages = mfMessages::getInstance();
        $this->form = new DomoprimeTypeLayerViewForm();
        $this->item_i18n=new DomoprimeTypeLayerI18n($request->getPostParameter('DomoprimeTypeLayerI18n'));        
   }

}

