<?php

/*
 * Generated by SuperAdmin Generator date : 24/04/13 15:45:29
 */
 
class app_domoprime_ajaxDeleteClassI18nAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {          
          $item=new mfValidatorInteger();
          $id=$item->isValid($request->getPostParameter('DomoprimeClassI18n'));          
          $item= new DomoprimeClassI18n($id);           
          $item->delete();              
          $response = array("action"=>"DeleteClassI18n","id" =>$id,"info"=>__("Class has been deleted."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

