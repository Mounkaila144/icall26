<?php


class app_domoprime_ajaxListDocumentForContractAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      $this->contract=new CustomerContract($request->getPostParameter('Contract'));
      if ($this->contract->isNotLoaded())
          return ;
      $request->addRequestParameter('contract', $this->contract);
      if ($this->contract->hasPolluter())
          $this->forward('app_domoprime','ajaxListPolluterDocumentForContract');      
      $this->forward('customers_meetings_forms_documents','ajaxListDocumentForContract');            
    }
}

