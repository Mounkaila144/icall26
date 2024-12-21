<?php


class customers_meetings_ajaxGenerateCoordinatesAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();
      try 
      {                
           $msgs=CustomerAddressBaseUtils::generateCoordinates();           
           $response=array('info'=> (string)$msgs->implode(","));
         //  SystemDebug::getInstance()->trace(date("Y-m-d H:i:s").":Meeting:GenerateCoordinates [".(string)$this->getUser()->getGuardUser()."] ");
      } 
      catch (mfException $e) {
           $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

