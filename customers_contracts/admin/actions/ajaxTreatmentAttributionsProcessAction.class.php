<?php


class customers_contracts_ajaxTreatmentAttributionsProcessAction extends mfAction {
    
       
    
  
        
    function execute(mfWebRequest $request) 
    {              
      $messages = mfMessages::getInstance();             
      try 
      {         
          CustomerContractContributor::updateAttributionsCompletion();
          $response = array("action"=>"TreatmentAttributionsProcess",  
                            "number_of_contracts"=>CustomerContractContributor::getNumberOfContractsToComplete(),
                            "info"=>__("Treatment Attributions Process has been done.")
                            );
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

