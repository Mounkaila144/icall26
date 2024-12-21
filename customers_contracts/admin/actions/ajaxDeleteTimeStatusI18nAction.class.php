<?php


class customers_contracts_ajaxDeleteTimeStatusI18nAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {         
          $item=new mfValidatorInteger();
          $id=$item->isValid($request->getPostParameter('CustomerContractTimeStatusI18n'));          
          $item= new CustomerContractTimeStatusI18n($id);           
          $item->delete();              
          $response = array("action"=>"DeleteTimeStatusI18n","id" =>$id,"info"=>__("Status has been deleted."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

