<?php

require_once dirname(__FILE__)."/../locales/Forms/ProductItemViewForm.class.php";
 

class products_items_ajaxViewItemForProductAction extends mfAction {
                 
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();  
        $this->settings= new ProductItemSettings();       
        $this->item = new ProductItem($request->getPostParameter('ProductItem')); // new object       
        $this->user=$this->getUser();
        $this->form = new ProductItemViewForm($this->item,array(),$this->getUser());              
    }

}
