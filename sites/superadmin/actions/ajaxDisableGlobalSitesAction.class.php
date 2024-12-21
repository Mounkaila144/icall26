<?php

class sites_ajaxDisableGlobalSitesAction extends mfAction {
    
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();
      try 
      {
          sitesAdmin:: disableGlobalSites();
          $response = array("action"=>"DisableGlobalSites"); 
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
