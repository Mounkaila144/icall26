<?php

require_once dirname(__FILE__)."/../locales/Forms/ProductActionViewForm.class.php";
 

class products_ajaxViewActionAction extends mfAction {
    
   
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->item = new ProductAction($request->getPostParameter('ProductAction')); // new object       
        $this->form = new ProductActionViewForm();              
    }

}
