<?php

require_once dirname(__FILE__)."/../locales/Forms/ProductActionViewForm.class.php";
 

class products_ajaxViewActionAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"sites","Admin");
        $this->item = new ProductAction($request->getPostParameter('ProductAction'),$this->site); // new object       
        $this->form = new ProductActionViewForm();              
    }

}
