<?php

require_once dirname(__FILE__).'/../locales/Forms/CustomerContractCompanyForm.class.php';

class customers_contracts_ajaxSaveCompanyAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();     
        $this->user=$this->getUser();
        $this->item=new CustomerContractCompany($request->getPostParameter('CustomerContractCompany'));    
        $this->form=new  CustomerContractCompanyForm($this->getUser(),$request->getPostParameter('CustomerContractCompany'));
        if (!$request->isMethod('POST') || !$request->getPostParameter('CustomerContractCompany') || $this->item->isNotLoaded())
            return ;
        $this->form->bind($request->getPostParameter('CustomerContractCompany'));
        try
        {
            if ($this->form->isValid())
            {
                $this->item->add($this->form->getValues());
                if ($this->item->isExist())
                    throw new mfException(__("Company already exists."));                                 
                $this->item->save();               
                $messages->addInfo(__("Company has been updated."));                
                $this->forward('customers_contracts','ajaxListPartialCompany');
            }   
            else
            {
                $messages->addError(__("Form has some errors."));
                $this->item->add($this->form->getDefaults());
                var_dump($this->form->getErrorSchema()->getErrorsMessage());
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
        
    }

}
