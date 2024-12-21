<?php


class app_domoprime_iso_ajaxDeleteOccupationI18nAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {         
          $item=new mfValidatorInteger();
          $id=$item->isValid($request->getPostParameter('DomoprimeOccupationI18n'));          
          $item= new DomoprimeOccupationI18n($id);           
          $item->delete();              
          $response = array("action"=>"DeleteOccupationI18n","id" =>$id,"info"=>__("Occupation has been deleted."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

