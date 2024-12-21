<?php

class dashboard_ajaxPreferencesDeleteBannerAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();   
      try 
      {
          $settings=new PreferencesSettings();
          $settings->deleteBanner();
         // var_dump($settings);
          $response = array("action"=>"deleteBanner");
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;      
    }
}

