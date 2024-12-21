<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeQuotationViewForContractForm.class.php";

class app_domoprime_ajaxSaveQuotationForContractAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
        $this->user=$this->getUser();
        $this->contract=$request->getRequestParameter('contract',new CustomerContract($request->getPostParameter('Contract')));
        if ($this->contract->isNotLoaded())
            return ;
        $this->quotation=new DomoprimeQuotation($request->getPostParameter('DomoprimeQuotation'));
        $this->form= new DomoprimeQuotationViewForContractForm($this->quotation,$this->getUser(),$request->getPostParameter('DomoprimeQuotation'));
        if (!$request->isMethod('POST') || !$request->getPostParameter('DomoprimeQuotation'))     
            return ;
        $this->form->bind($request->getPostParameter('DomoprimeQuotation'));
        if ($this->form->isValid())
        {
            //echo "<pre>"; var_dump($this->form->getValues()); echo "</pre>";            
            $this->quotation->updateFromContract($this->form,$this->getUser()->getGuardUser());
            $messages->addInfo(__('Quotation has been updated'));
            $request->addRequestParameter('contract', $this->contract);
            $this->forward($this->getModuleName(), 'ajaxListPartialQuotationForContract');
        }   
        else
        {
            $messages->addError(__("Form has some errors."));
           // echo "<pre>";var_dump($this->form->getErrorSchema()->getErrorsMessage()); echo "</pre>";
        }       
    }

}
