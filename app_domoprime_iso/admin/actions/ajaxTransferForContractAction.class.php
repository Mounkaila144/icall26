<?php



class app_domoprime_iso_ajaxTransferForContractAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                     
        try 
        {
           $response=array('action'=>'TransferForContract');
           $contract=new CustomerContract($request->getPostParameter('Contract'));
           if ($contract->isNotLoaded())
               throw new mfException(__('Contract is invalid.'));
           if ($contract->isHold())
              throw new mfException(__('Contract is hold.')); 
           $request_form = new DomoprimeCustomerRequest($contract); 
           if ($request_form->isLoaded()) 
           {
                $response["info"]=__("Request already exists.");
           }
           else
           {   
                $request_form->transferFormToRequestFromCOntract();
                $response["number_of_request"]=DomoprimeCustomerRequest::getNumberOfTransferredRequestForContracts();
                $response["info"]=__("Forms /Contracts have been transferred.");
           }
        } 
        catch (mfException $e) 
        {
            $messages->addError($e->getMessage());
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
