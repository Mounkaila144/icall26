<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeQuotationNewForContractForm.class.php";

class app_domoprime_ajaxNewQuotationForContractAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
        $this->user=$this->getUser();
        $this->contract=$request->getRequestParameter('contract',new CustomerContract($request->getPostParameter('Contract')));
        if ($this->contract->isNotLoaded())
            return ;       
        $this->form= new DomoprimeQuotationNewForContractForm($this->user,$this->contract,$request->getPostParameter('DomoprimeQuotation'));
        $this->quotation=new DomoprimeQuotation();
        $this->quotation->add($this->form->getDefaults());
        if (!$request->isMethod('POST') || !$request->getPostParameter('DomoprimeQuotation'))     
            return ;
        $this->form->bind($request->getPostParameter('DomoprimeQuotation'));
        if ($this->form->isValid())
        {
            //echo "<pre>"; var_dump($this->form->getValues()); echo "</pre>";            
            $this->quotation->createFromContract($this->contract,$this->form,$this->getUser()->getGuardUser());
            $messages->addInfo(__('Quotation has been created'));
            $request->addRequestParameter('contract', $this->contract);
            $request->addRequestParameter('is_from_new', true);
            $this->forward($this->getModuleName(), 'ajaxListPartialQuotationForContract');
        }   
        else
        {
            $messages->addError(__("Form has some errors."));
         //  echo "<pre>";var_dump($this->form->getErrorSchema()->getErrorsMessage()); echo "</pre>";
        }       
    }

}
