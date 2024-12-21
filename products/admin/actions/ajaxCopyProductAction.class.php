<?php


class products_ajaxCopyProductAction extends mfAction {
    
    public function execute(\mfWebRequest $request) {        
        $messages= mfMessages::getInstance();
        try {
            if (!$this->getUser()->hasCredential(array(array('superadmin','settings_product_copy'))))
                    $this->forwardTo401Action ();
            $item=new Product($request->getPostParameter('Product'));
            if ($item->isNotLoaded())
                throw new mfException(__("Product is invalid."));
             //ProductItemEvents::copyProductItemsWithLinks($copy=$item->copyAndSave(),$item);
             $this->getEventDispather()->notify(new mfEvent($copy=$item->copyAndSave(),'product.copy',array('source'=>$item)));                                                                 
             $messages->addInfo(__("Product %s has been copied.",$item->getMetaTitle()));     
             $this->forward($this->getModuleName(), 'ajaxListPartialProduct');
            
        } catch (mfException $ex) {
            
            $messages->addError($ex);
        }
        $this->getController()->setRenderMode(mfView::RENDER_JSON);
        $response=array(
                "action"=>"CopyProduct",
                "info"=>__("Product %s has been copied.",$item->getMetaTitle())
                
        );
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
        
    }

}
