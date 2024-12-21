<?php

class partners_polluter_ajaxDeletePictureAction extends mfAction {
    

    function execute(mfWebRequest $request) {     
      $messages = mfMessages::getInstance();      
      try 
      {                  
          $polluter= new PartnerPolluterCompany($request->getPostParameter('PartnerPolluter'));
          if ($polluter->get('picture') && $polluter->isLoaded())
          {    
            $polluter->deletePicture();
            $response = array("action"=>"DeletePicture","id" =>$polluter->get('id'));
          }  
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
