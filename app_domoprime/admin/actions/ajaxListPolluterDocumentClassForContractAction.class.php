<?php


class app_domoprime_ajaxListPolluterDocumentClassForContractAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      $this->contract=$request->getRequestParameter('contract',new CustomerContract($request->getPostParameter('Contract')));               
      $this->documents=DomoprimeCustomerMeetingFormDocument::getPolluterDocumentsForContract($this->contract,$this->getUser());                   
      $this->user=$this->getUser();       
      if ($this->documents->isEmpty())
      {
           $messages->addWarning(__('No document found for polluter, default document token.')).
           $this->forward('app_domoprime','ajaxListDocumentsClassForContract');                               
      }    
    }
}

