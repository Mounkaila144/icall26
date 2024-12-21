<?php


class customers_ajaxGenerateCoordinatesAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {                    
          CustomerAddressUtils::generateCoordinates();           
          $response = array("info"=>__("Coordinates has been calculated for all meetings."));         
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

