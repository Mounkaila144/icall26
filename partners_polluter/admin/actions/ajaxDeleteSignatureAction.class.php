<?php

class partners_polluter_ajaxDeleteSignatureAction extends mfAction {
    

    function execute(mfWebRequest $request) {     
      $messages = mfMessages::getInstance();      
      try 
      {                  
          $polluter= new PartnerPolluterCompany($request->getPostParameter('PartnerPolluter'));
          if ($polluter->get('signature') && $polluter->isLoaded())
          {    
            $polluter->deleteSignature();
            $response = array("action"=>"DeleteSignature","id" =>$polluter->get('id'));
          }  
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
