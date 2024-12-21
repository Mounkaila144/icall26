<?php



class app_domoprime_iso_ajaxGenerateForContractAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                     
        try 
        {
           $contract=new CustomerContract($request->getPostParameter('Contract'));
           if ($contract->isNotLoaded())
               throw new mfException(__('Contract is invalid.'));
           if ($contract->isHold())
               throw new mfException(__('Contract is hold.')); 
           $engine=new DomoprimeIsoEngine($contract);
           $engine->process();
           $report=new DomoprimeCalculation($engine);
           $report->process($this->getUser()->getGuardUser());   
           $response=array('info'=>__('Cumac has been generated.'));
        } 
        catch (mfException $e) 
        {
            $messages->addError($e->getMessage());
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
