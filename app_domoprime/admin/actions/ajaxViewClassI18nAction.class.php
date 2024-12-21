<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeClassViewForm.class.php";
 
class app_domoprime_ajaxViewClassI18nAction extends mfAction {
    
   
    
  
        
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();
        $this->form = new DomoprimeClassViewForm($this->getUser());
        $this->item_i18n=new DomoprimeClassI18n($request->getPostParameter('DomoprimeClassI18n'));        
   }

}

