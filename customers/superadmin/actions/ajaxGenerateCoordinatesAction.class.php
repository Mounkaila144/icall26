<?php


class customers_ajaxGenerateCoordinatesAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {
          $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
          if (!$site) 
              throw new mfException(__("thanks to select a site"));             
          CustomerAddressUtils::generateCoordinates($site);           
          $response = array("info"=>__("Coordinates has been calculated for all meetings."));         
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

