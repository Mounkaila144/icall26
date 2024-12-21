<?php

class cron_ajaxDeleteCacheCronAction extends mfAction {
    
    function execute(mfWebRequest $request) { 
      if (!$request->isXmlHttpRequest()) 
            $this->redirect("/superadmin/cron");
      $messages = mfMessages::getInstance();   
      try 
      {
          $this->getContext()->getConfigCache()->remove('config/cron.php');
          $response = array("action"=>"deleteCacheCron","info"=>__('cache is cleared.'));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

