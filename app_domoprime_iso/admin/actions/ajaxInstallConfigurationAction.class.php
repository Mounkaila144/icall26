<?php


class app_domoprime_iso_ajaxInstallConfigurationAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {         
          DomoprimeIsoUtils::migrateModels();
          $this->getEventDispather()->notify(new mfEvent($this, 'app.domoprime.iso.install.config'));           
          $response = array("action"=>"InstallConfiguration","info"=>__("Configuration installed."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

