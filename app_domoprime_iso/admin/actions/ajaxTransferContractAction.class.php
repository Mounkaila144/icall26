<?php


class app_domoprime_iso_ajaxTransferContractAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {         
          DomoprimeCustomerRequest::transferFormContractsToRequest();
          $response = array("action"=>"TransferContract",
                            "number_of_request"=>DomoprimeCustomerRequest::getNumberOfTransferredRequestForContract(),
                            "info"=>__("Forms have been transferred."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

