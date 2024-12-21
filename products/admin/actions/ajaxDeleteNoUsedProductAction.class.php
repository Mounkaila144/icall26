<?php


class products_ajaxDeleteNoUsedProductAction extends mfAction {
    
   
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {         
          $item=new mfValidatorInteger();
          $id=$item->isValid($request->getPostParameter('Product'));          
          $item= new Product($id); 
          
          if($item->isNotUsed()){
                $item->delete();   
                $response = array("action"=>"DeleteNoUsedProduct","id" =>$id,"info"=>__("Product [%s] has been deleted.",$item->get('meta_title'))); 
          }
          else{
                $response = array("action"=>"DeleteNoUsedProduct","id" =>$id,"error"=>__("The product [%s] Could not been deleted.",$item->get('meta_title'))); 
          }
          
      } 
      catch (mfException $e) {
          
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

