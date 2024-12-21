<?php

class products_ajaxGenerateProductForContractAndMeetingAction extends mfAction {
    
    public function execute(\mfWebRequest $request) {        
        $messages= mfMessages::getInstance();
        try {
            if (!$this->getUser()->hasCredential(array(array('superadmin','settings_product_generate_product'))))
                    $this->forwardTo401Action ();
            $item=new Product($request->getPostParameter('Product'));
            if ($item->isNotLoaded())
                throw new mfException(__("Product is invalid."));
                                                           
            CustomerContractUtils::createDefaultProductForContracts($item);
            $response=array(
                "action"=>"GenerateProductForContractAndMeeting",
                "product"=>$item->get('id'),
                "countRestProducts"=>$item->getContractAndMeetingProductsRestCount(),
                "countRestContractProducts"=>$item->getRestProductsForContract(),
                "countRestMeetingProducts"=>$item->getRestProductsForMeeting(),
                "countContractProducts"=>$item->getAllProductsForContract(),
                "countMeetingProducts"=>$item->getAllProductsForMeeting(),
                "info"=>__("Product %s has been generated for contracts and meetings.",$item->getMetaTitle())           
            );
            
        } catch (mfException $ex) {
            
            $messages->addError($ex);
        }        
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
        
    }

}
