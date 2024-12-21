<?php


class app_domoprime_iso_ajaxDocumentForContractAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      $this->user=$this->getUser();
      $this->contract=new CustomerContract($request->getPostParameter('Contract'));    
      if ($this->contract->isNotLoaded())
          return ;
      try
      {
        $this->engine= new DomoprimeIsoDocumentEngine($this->contract);
        $this->engine->process();
      }
      catch (mfException $e)
      {
          $messages->addError($e);
      }
    }
}

