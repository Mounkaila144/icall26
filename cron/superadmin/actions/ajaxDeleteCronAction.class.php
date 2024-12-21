<?php

class cron_ajaxDeleteCronAction extends mfAction {
    
    function execute(mfWebRequest $request) { 
      if (!$request->isXmlHttpRequest()) 
            $this->redirect("/superadmin/crons");
      $messages = mfMessages::getInstance();   
      try 
      {
          $cronValidator=new mfValidatorInteger();
          $cron_id=$cronValidator->isValid($request->getPostParameter('cron'));
          $cron= new Cron($cron_id); 
          if ($cron->isLoaded())
          {    
             $cron->getReport()->delete();
             $cron->delete();
             $response = array("action"=>"deleteCron",
                               "info"=>__("Cron has been deleted"),
                              "id" =>$cron->get('id'));
          }
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

