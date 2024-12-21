<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerUnionViewForm.class.php";
 
class customers_ajaxViewUnionI18nAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    

        
    function execute(mfWebRequest $request) {              
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);    
        $this->forwardIf(!$this->site,"sites","Admin");
        $messages = mfMessages::getInstance();
        $this->form = new CustomerUnionViewForm();
        $this->item=new CustomerUnionI18n($request->getPostParameter('CustomerUnionI18n'),$this->site);        
   }

}

