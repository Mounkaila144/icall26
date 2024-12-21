<?php


class app_domoprime_ajaxDeleteTypeAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {                    
          $item= new DomoprimeSubventionType($request->getPostParameter('DomoprimeSubventionType'));           
          $item->delete();              
          $response = array("action"=>"DeleteTypel","id" =>$item->get('id'),"info"=>__("Type has been deleted."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

