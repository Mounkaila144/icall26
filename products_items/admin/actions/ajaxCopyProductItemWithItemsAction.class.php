<?php


class products_items_ajaxCopyProductItemWithItemsAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {  
        
        $messages= mfMessages::getInstance();
        try {
            $item=new ProductItem($request->getPostParameter('ProductItem'));            
            if ($item->isNotLoaded())
                throw new mfException(__("Item is invalid."));
             ProductItemUtils::copyItemsWithLinksFrom($item);
             $messages->addInfo(__("Item %s has been copied.",$item->get('reference'))); 
             $request->addRequestParameter('product', $item->getProduct());
             $this->forward($this->getModuleName(), 'ajax'.$request->getPostParameter('callback','ListPartialItemMasterSlave'));
            
        } catch (mfException $ex) {
            
            $messages->addError($ex);
        }
        $this->getController()->setRenderMode(mfView::RENDER_JSON);
        $response=array(
                "action"=>"CopyProductItemWithItems",
                "info"=>__("Item %s has been copied.",$item->get('reference'))
                
        );
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
        
    }

}
