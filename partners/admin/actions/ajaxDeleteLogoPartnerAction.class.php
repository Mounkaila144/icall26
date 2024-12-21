<?php

class partners_ajaxDeleteLogoPartnerAction extends mfAction {
    

    function execute(mfWebRequest $request) {     
      $messages = mfMessages::getInstance();      
      try 
      {                  
          $partner= new Partner($request->getPostParameter('Partner'));
          if ($partner->get('logo') && $partner->isLoaded())
          {    
              
            $partner->deleteLogo();
            $response = array("action"=>"DeleteLogo","id" =>$partner->get('id'));
          }  
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
