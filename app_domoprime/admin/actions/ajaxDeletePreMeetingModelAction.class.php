<?php


class app_domoprime_ajaxDeletePreMeetingModelAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {                    
          $item= new DomoprimePreMeetingModel($request->getPostParameter('DomoprimePreMeetingModel'));           
          $item->delete();              
          $response = array("action"=>"DeleteModel","id" =>$item->get('id'),"info"=>__("Model has been deleted."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

