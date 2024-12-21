<?php


class products_ajaxDeleteProductAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {          
          $item=new mfValidatorInteger();
          $id=$item->isValid($request->getPostParameter('Product'));          
          $item= new Product($id);           
          $item->disable();              
          $response = array("action"=>"deleteProduct","id" =>$id,"info"=>__("Product [%s] has been deleted.",$item->get('meta_title')));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

