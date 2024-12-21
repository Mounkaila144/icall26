<?php

class dashboard_ajaxPreferencesDeleteFaviconAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();   
      try 
      {
          $settings=new PreferencesSettings();
          $settings->deleteFavicon();
         // var_dump($settings);
          $response = array("action"=>"deleteFavicon");
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;      
    }
}

