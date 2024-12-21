<?php

require_once dirname(__FILE__)."/../locales/Forms/ProductViewForm.class.php";
 

class products_ajaxViewProductAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"sites","Admin");
        $this->user=$this->getUser();
        $this->item = new Product($request->getPostParameter('Product'),$this->site); // new object       
        $this->form = new ProductViewForm(array(),$this->user,$this->site);              
    }

}
