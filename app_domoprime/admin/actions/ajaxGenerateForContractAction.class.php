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
           try
           {
                $engine=new DomoprimeIsoEngine($contract);
                $engine->process();                                    
                $report=new DomoprimeCalculation($engine);
                $report->process($this->getUser()->getGuardUser());      
           }
           catch (mfException $e)
           {
               // Remove last calculation
                $report=new DomoprimeCalculation($contract);
                $report->release();
                throw $e;
            }  
           $response=array('info'=>__('Cumac has been generated.'));
        } 
        catch (mfException $e) 
        {
            $messages->addError($e->getMessage());           
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
