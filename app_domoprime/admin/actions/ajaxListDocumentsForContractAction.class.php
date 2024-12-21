<?php

class app_domoprime_ajaxListDocumentsForContractAction extends mfAction {
    
    
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();         
        $this->user=$this->getUser();
        $this->contract=$request->getRequestParameter('contract',new CustomerContract($request->getPostParameter('Contract')));    
        try
        {
         $this->documents=CustomerMeetingFormDocument::getDocumentsForContract($this->contract,$this->getUser());
      //   $this->documents=DomoprimeCustomerMeetingFormDocument::getDocumentsForContract($this->contract,$this->getUser());         
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }

}
