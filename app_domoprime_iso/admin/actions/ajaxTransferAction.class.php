<?php


class app_domoprime_iso_ajaxTransferAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {         
          DomoprimeCustomerRequest::transferFormToRequest();
          $response = array("action"=>"Transfer",
                            "number_of_request"=>DomoprimeCustomerRequest::getNumberOfTransferredRequest(),
                            "info"=>__("Forms have been transferred."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

