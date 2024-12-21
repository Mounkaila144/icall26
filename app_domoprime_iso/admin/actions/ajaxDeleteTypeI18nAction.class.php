<?php


class app_domoprime_iso_ajaxDeleteTypeI18nAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {         
          $item=new mfValidatorInteger();
          $id=$item->isValid($request->getPostParameter('DomoprimeTypeI18n'));          
          $item= new DomoprimeTypeI18n($id);           
          $item->delete();              
          $response = array("action"=>"DeleteTypeI18n","id" =>$id,"info"=>__("Type has been deleted."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

