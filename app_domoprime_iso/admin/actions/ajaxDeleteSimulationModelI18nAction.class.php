<?php


class app_domoprime_iso_ajaxDeleteSimulationModelI18nAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {        
          $item=new mfValidatorInteger();
          $id=$item->isValid($request->getPostParameter('DomoprimeSimulationModelI18n'));          
          $item= new DomoprimeSimulationModelI18n($id);           
          $item->delete();              
          $response = array("action"=>"DeleteModelI18n","id" =>$id,"info"=>__("Model has been deleted."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

