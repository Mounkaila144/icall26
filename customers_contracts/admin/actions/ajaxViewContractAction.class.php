<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractViewForm.class.php";



class customers_contracts_ajaxViewContractAction extends mfAction {
    
           
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();          
        $this->user=$this->getUser();        
        $this->contract=$request->getRequestParameter('contract',new CustomerContract($request->getGetAndPostParameter('Contract')));    
        $this->form= new CustomerContractViewForm($this->getUser(),$this->contract); 
     
        $this->getEventDispather()->notify(new mfEvent($this->form, 'contract.form'));  
        $request->addRequestParameter('contract', $this->contract);
        if (!$this->contract->isUserAuthorized($this->getUser(),'view'))
            $this->forwardTo401Action();    
        $this->settings_contract=CustomerContractSettings::load();               
        if ($this->contract->isHold())
            $messages->addWarning(__("Contract is hold."));           
        $this->getEventDispather()->notify(new mfEvent($this->contract, 'contract.view'));
      // var_dump($this->getUser());
        //die(__METHOD__);
    }

}
