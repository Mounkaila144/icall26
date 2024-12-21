<?php


class app_domoprime_ajaxGenerateDocumentsForContractAction extends mfAction{
    
    function execute(mfWebRequest $request){
      
        $messages = mfMessages::getInstance();   
        try 
        {        
           $contract=new CustomerContract($request->getPostParameter('Contract'));
           if ($contract->isNotLoaded())
               throw new mfException(__('Contract is invalid.'));
           if ($contract->isHold())
               throw new mfException(__('Contract is hold.')); 
           $generator=new DomoprimeDocumentsGenerator( $contract, $this->getUser());
           $generator->process();                      
           $response = array("action"=>"GenerateDocuments",
                              "info"=>__("Documents have been generated."));
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
   
}
