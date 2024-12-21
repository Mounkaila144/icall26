<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractProductNewForm.class.php";

class customers_contracts_ajaxNewContractProductAction extends mfAction {
    
        
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();  
        $this->user=$this->getUser();
        $this->contract=new CustomerContract($request->getPostParameter('Contract'));  
        if ($this->contract->isNotLoaded())
             return ;
        try
        {
            $this->item=new CustomerContractProduct();
            $this->item->set('contract_id',$this->contract);
            $this->form=new CustomerContractProductNewForm($request->getPostParameter('ContractProduct'),$this->user); 
            if ($request->isMethod('POST') && $request->getPostParameter('ContractProduct'))
            {           
                $this->form->bind($request->getPostParameter('ContractProduct'));
                if ($this->form->isValid())
                {                    
                    $this->item->add($this->form->getValues());
                    if ($this->item->isExist() && $this->getUser()->hasCredential(array(array('contract_product_new_no_double'))))
                        throw new mfException(__("Product already exists."));
                    if (!$this->item->hasTax())
                        $this->item->set('tva_id',$this->item->getProduct()->get('tva_id'));    
                    $this->item->save();
                    $messages->addInfo(__("Product has been created."));
                    $request->addRequestParameter('meeting', $this->item->getContract());
                    $this->forward('customers_contracts', 'ajaxListContractProduct');
                }   
                else
                {
                     $messages->addError(__("Form has some errors."));
                     $this->item->add($this->form->getDefaults());
                }    
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }

}
