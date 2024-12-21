<?php

require_once dirname(__FILE__)."/../locales/Forms/ProductItemsViewForm.class.php";
 
class products_items_ajaxViewItemListMasterSlaveForProductAction extends mfAction {
                 
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance(); 
        $this->productItem=$request->getRequestParameter('ProductItem',new ProductItem($request->getPostParameter('ProductItem')));
        $this->form = new ProductItemsViewForm($this->productItem,$this->getUser());
    }

}
