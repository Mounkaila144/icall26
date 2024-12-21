<?php

require_once dirname(__FILE__)."/../locales/Forms/SystemMenuViewForm.class.php";
 
class dashboard_ajaxViewSystemMenuI18nAction extends mfAction {
    
  
        
    function execute(mfWebRequest $request) {              
     
        $messages = mfMessages::getInstance();
        $this->form = new SystemMenuViewForm();
        $this->item_i18n=new SystemMenuI18n($request->getPostParameter('SystemMenuI18n'));        
      //  echo "<pre>";var_dump($this->item_i18n);echo "</pre>";
   }

}

