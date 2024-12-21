<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeAssetModelViewForm.class.php";
 
class app_domoprime_ajaxViewAssetModelI18nAction extends mfAction {
    
    
    
   
        
    function execute(mfWebRequest $request) {                   
        $messages = mfMessages::getInstance();
        $this->form = new DomoprimeAssetModelViewForm();
        $this->item_i18n=new DomoprimeAssetModelI18n($request->getPostParameter('DomoprimeAssetModelI18n'));    
        $this->country=$this->getUser()->getCountry();
   }

}

