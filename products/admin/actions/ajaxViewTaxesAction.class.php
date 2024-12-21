<?php

require_once dirname(__FILE__)."/../locales/Forms/TaxViewForm.class.php";
 
 
class products_ajaxViewTaxesAction extends mfAction {

     
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();             
        $this->form = new TaxViewForm();   
        $this->item=new Tax($request->getPostParameter('Tax'),$this->site);
         
    }

}