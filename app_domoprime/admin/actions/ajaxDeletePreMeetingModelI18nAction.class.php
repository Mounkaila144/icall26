<?php


class app_domoprime_ajaxDeletePreMeetingModelI18nAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {                    
          $item= new DomoprimePreMeetingModelI18n($request->getPostParameter('DomoprimePreMeetingModelI18n'));           
          $item->delete();              
          $response = array("action"=>"DeleteModelI18n","id" =>$item->get('id'),"info"=>__("Model has been deleted."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

