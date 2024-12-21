<?php

class dashboard_ajaxPreferencesDeleteFaviconIcoAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();   
      try 
      {
          $settings=new PreferencesSettings();
          $settings->deleteFaviconIco();
         // var_dump($settings);
          $response = array("action"=>"deleteFaviconIco");
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;      
    }
}

