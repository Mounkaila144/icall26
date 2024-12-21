<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeQuotationNew2ForContractForm.class.php";

class app_domoprime_ajaxNewQuotation2ForContractAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
        $this->user=$this->getUser();
        $this->contract=$request->getRequestParameter('contract',new CustomerContract($request->getPostParameter('Contract')));
        if ($this->contract->isNotLoaded())
            return ;   
        try
        {
              if (!$this->contract->hasPolluter())
                  throw new mfException(__("Polluter doesn't exist"));
                  //      echo "<pre>"; var_dump($request->getPostParameter('DomoprimeQuotation')); echo "</pre>";
              $this->form= new DomoprimeQuotationNew2ForContractForm($this->user,$this->contract,$request->getPostParameter('DomoprimeQuotation'));
              $this->quotation=new DomoprimeQuotation();       
              if (!$request->isMethod('POST') || !$request->getPostParameter('DomoprimeQuotation'))     
                  return ;
              $this->form->bind($request->getPostParameter('DomoprimeQuotation'));
              if ($this->form->isValid())
              {
                  //echo "<pre>"; var_dump($this->form->getValues()); echo "</pre>";            
                  $this->quotation->create2FromContract($this->contract,$this->form,$this->getUser()->getGuardUser());
                  $messages->addInfo(__('Quotation has been created'));
                  $request->addRequestParameter('contract', $this->contract);
                  $this->forward($this->getModuleName(), 'ajaxListPartialQuotationForContract');
              }   
              else
              {
                  $messages->addError(__("Form has some errors."));
                // echo "<pre>";var_dump($this->form->getErrorSchema()->getErrorsMessage()); echo "</pre>";
              }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }

}
