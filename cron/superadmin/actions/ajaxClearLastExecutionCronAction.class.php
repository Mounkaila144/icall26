<?php

class cron_ajaxClearLastExecutionCronAction extends mfAction {
    
    function execute(mfWebRequest $request) {        
      $messages = mfMessages::getInstance();   
      try 
      {         
          $cron= new Cron($request->getPostParameter('Cron'));
          if ($cron->isLoaded()) 
          {    
              $cron->set('last_execution',null);
              $cron->save();
              $response = array("action"=>"ClearLastExecutionCron",
                                "info"=>__('Last execution has been removed.'),
                                "id"=>$cron->get('id'));
          }    
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

