<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerUnionViewForm.class.php";
 
class customers_ajaxViewUnionI18nAction extends mfAction {
    
    
    

        
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();
        $this->form = new CustomerUnionViewForm();
        $this->item=new CustomerUnionI18n($request->getPostParameter('CustomerUnionI18n'));        
   }

}

