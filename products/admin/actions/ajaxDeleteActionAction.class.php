<?php


class products_ajaxDeleteActionAction extends mfAction {
    
   
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {         
          $item=new mfValidatorInteger();
          $id=$item->isValid($request->getPostParameter('ProductAction'));          
          $item= new ProductAction($id);           
          $item->delete();              
          $response = array("action"=>"DeleteAction","id" =>$id,"info"=>__("Action [%s] has been deleted.",$item->get('action')));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

