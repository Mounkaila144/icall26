<?php


class products_ajaxEnableProductAction extends mfAction {
    
    function execute(mfWebRequest $request) 
    {              
      $messages = mfMessages::getInstance();             
      try 
      {                            
          $item=new Product($request->getPostParameter('Product'));                       
      
          $item->Enable();                                                           
          $item->save();          
             
          $response = array("action"=>"EnableProduct",
                            "id" =>$item->get('id'),         
                            "info"=>__("Product is enabled."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
