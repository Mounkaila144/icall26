<?php


require_once __DIR__."/../locales/Api/FormFilters/ProductItemsApiFormFilter.class.php";
require_once __DIR__."/../locales/Pagers/ProductItemPager.class.php";
require_once __DIR__."/../locales/Api/ProductItemListFormatterApi.class.php";

class products_items_apiListItemsAction extends mfAction {

    function execute(mfWebRequest $request) {
        
        $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*');
        $messages = mfMessages::getInstance();          
        if (!$this->getUser()->hasCredential(array(array('superadmin','admin'))))
            $this->forwardTo401Action();                         
         $data = new ProductItemListFormatterApi($this);               
         return $data->toArray();
    }

}