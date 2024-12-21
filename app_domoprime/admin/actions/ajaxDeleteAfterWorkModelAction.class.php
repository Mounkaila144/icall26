<?php


class app_domoprime_ajaxDeleteAfterWorkModelAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {                    
          $item= new DomoprimeAfterWorkModel($request->getPostParameter('DomoprimeAfterWorkModel'));           
          $item->delete();              
          $response = array("action"=>"DeleteModel","id" =>$item->get('id'),"info"=>__("Model has been deleted."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

