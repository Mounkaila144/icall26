<?php


class app_domoprime_ajaxListDocumentClassForContractAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      $this->contract=new CustomerContract($request->getPostParameter('Contract'));
      if ($this->contract->isNotLoaded())
          return ;
      $request->addRequestParameter('contract', $this->contract);
      if ($this->contract->hasPolluter())
          $this->forward('app_domoprime','ajaxListPolluterDocumentClassForContract');      
     // $this->forward('customers_meetings_forms_documents','ajaxListDocumentForContract');            
      $this->forward('app_domoprime','ajaxListDocumentsClassForContract');  
    }
}

