<?php

require_once dirname(__FILE__)."/../locales/Forms/TaxViewForm.class.php";
 
 
class products_ajaxViewTaxesAction extends mfAction {

     const SITE_NAMESPACE = 'system/site';
     
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);        
        $this->forwardIf(!$this->site,"sites","ajaxAdmin");         
        $this->form = new TaxViewForm();   
        $this->item=new Tax($request->getPostParameter('Tax'),$this->site);
         
    }

}