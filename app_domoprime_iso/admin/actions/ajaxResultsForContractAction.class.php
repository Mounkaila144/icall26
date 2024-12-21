<?php



class app_domoprime_iso_ajaxResultsForContractAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();  
        $this->user=$this->getUser();
        $this->contract=new CustomerContract($request->getPostParameter('Contract'));       
        try 
        {           
           $this->engine=new DomoprimeIsoEngine($this->contract);
           $this->engine->process();                                    
           $this->report=new DomoprimeCalculation($this->engine);
           $this->report->process($this->getUser()->getGuardUser());               
        } 
        catch (mfException $e) 
        {
            $messages->addError($e->getMessage());
        }
      //   var_dump($this->engine->getCauses());
    }

}
