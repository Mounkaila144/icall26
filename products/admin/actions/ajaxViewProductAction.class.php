<?php

require_once dirname(__FILE__)."/../locales/Forms/ProductViewForm.class.php";
 

class products_ajaxViewProductAction extends mfAction {
    
        
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->item = new Product($request->getPostParameter('Product')); // new object       
        $this->user=$this->getUser();
        $this->form = new ProductViewForm(array(),$this->user);              
    }

}
