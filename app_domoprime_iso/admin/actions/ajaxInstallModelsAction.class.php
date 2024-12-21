<?php


class app_domoprime_iso_ajaxInstallModelsAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {    
          DomoprimeIsoUtils::migrateModels();         
          $response = array("action"=>"InstallModels","info"=>__("Models have been updated."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

