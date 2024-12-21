<?php


class products_items_ajaxListItemsForNewSlaveAction extends mfAction{
    
    function execute(mfWebRequest $request) {
        
      $messages = mfMessages::getInstance();   
      try 
      {                        
            $item=new ProductItem($request->getPostParameter('ProductItem'));
            $response = array("action"=>"ListItemsForNewSlave",
                              "items" => $item->getItemsNotInProductForSelect()->toArray()
                    );
          }
       
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    
             
    }
}



 