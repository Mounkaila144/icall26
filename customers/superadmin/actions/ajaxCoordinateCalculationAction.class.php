<?php


class customers_ajaxCoordinateCalculationAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {
          $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
          if (!$site) 
              throw new mfException(__("thanks to select a site"));             
          $item= new Customer($request->getPostParameter('Customer'),$site);           
          if ($item->isLoaded())
          {    
            if ($item->getAddress()->calculateCoordinates())  
            {
                $item->getAddress()->save();
                $response = array("info"=>__("Coordinates have been calculated."),   
                                  "action"=>"CoordinateCalculation",
                                  "coordinates"=>$item->getAddress()->getCoordinates());
            }
            else
                $response = array("warning"=>__("Coordinates are not calculated."));
          }  
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

