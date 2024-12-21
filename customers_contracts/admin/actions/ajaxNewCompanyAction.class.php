<?php
require_once dirname(__FILE__)."/../locales/Forms/CustomerContractCompanyNewForm.class.php";

class customers_contracts_ajaxNewCompanyAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();  
        $this->user=$this->getUser();
        try
        {
            $this->item=new CustomerContractCompany();
            $this->form=new CustomerContractCompanyNewForm($this->getUser(),$request->getPostParameter('CustomerContractCompany')); 
            if ($request->isMethod('POST') && $request->getPostParameter('CustomerContractCompany'))
            {           
                $this->form->bind($request->getPostParameter('CustomerContractCompany'));
                if ($this->form->isValid())
                {                    
                    $this->item->add($this->form->getValues());
                    if ($this->item->isExist())
                        throw new mfException(__("Company already exists."));  
                    $this->item->save();
                    $messages->addInfo(__("Company has been created."));
                    $this->forward('customers_contracts', 'ajaxListCompany');
                }   
                else
                {
                     $messages->addError(__("Form has some errors."));
                     $this->item->add($this->form->getDefaults());
                  //   var_dump($this->form->getErrorSchema()->getErrorsMessage());
                }    
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
        
    }

}
