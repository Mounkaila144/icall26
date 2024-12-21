<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractProductNewForm.class.php";

class customers_contracts_ajaxNewContractProductAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");  
        $this->contract=new CustomerContract($request->getPostParameter('Contract'),$this->site);  
        if ($this->contract->isNotLoaded())
             return ;
        try
        {
            $this->item=new CustomerContractProduct(null,$this->site);
            $this->item->set('contract_id',$this->contract);
            $this->form=new CustomerContractProductNewForm($request->getPostParameter('ContractProduct'),$this->site); 
            if ($request->isMethod('POST') && $request->getPostParameter('ContractProduct'))
            {           
                $this->form->bind($request->getPostParameter('ContractProduct'));
                if ($this->form->isValid())
                {
                    $this->item->add($this->form->getValues());
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
