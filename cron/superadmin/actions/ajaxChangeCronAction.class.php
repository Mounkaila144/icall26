<?php

class cron_ajaxChangeCronAction extends mfAction {
    
    function execute(mfWebRequest $request) {   
      if (!$request->isXmlHttpRequest()) 
            $this->redirect("/superadmin/cron");
      $messages = mfMessages::getInstance();   
      try 
      {
          $cronValidator=new mfValidatorInteger();
          $value=new mfValidatorBoolean();
          $cron_id=$cronValidator->isValid($request->getPostParameter('id'));
          $value=$value->isValid($request->getPostParameter('value'))?"NO":"YES";
          $cron= new Cron($cron_id);
          if ($cron->isLoaded()) 
          {    
              $cron->set('is_active',$value);
              $cron->save();
              $response = array("action"=>"ChangeCron","id"=>$cron_id,"state" =>$value);
          }    
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

