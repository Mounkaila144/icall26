<?php

class partners_polluter_ajaxDeleteLogoAction extends mfAction {
    

    function execute(mfWebRequest $request) {     
      $messages = mfMessages::getInstance();      
      try 
      {                  
          $polluter= new PartnerPolluterCompany($request->getPostParameter('PartnerPolluter'));
          if ($polluter->get('logo') && $polluter->isLoaded())
          {    
            $polluter->deleteLogo();
            $response = array("action"=>"DeleteLogo","id" =>$polluter->get('id'));
          }  
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
