<?php

class cron_ajaxDeleteDatabaseAction extends mfAction {
    
    function execute(mfWebRequest $request) { 
      if (!$request->isXmlHttpRequest()) 
            $this->redirect("/superadmin/cron");
      $messages = mfMessages::getInstance();   
      try 
      {
          CronUtils::clearDatabase();
          $response = array("action"=>"deleteDatabase","info"=>__('database is cleared.'));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

