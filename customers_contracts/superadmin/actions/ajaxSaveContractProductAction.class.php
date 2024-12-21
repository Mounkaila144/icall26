<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractProductViewForm.class.php";



class customers_contracts_ajaxSaveContractProductAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");                 
        $this->item=new  CustomerContractProduct($request->getPostParameter('ContractProduct'),$this->site);  
        if ($this->item->isNotLoaded())
            return ;
        $this->form=new CustomerContractProductViewForm($request->getPostParameter('ContractProduct'),$this->site); 
        if ($request->isMethod('POST') && $request->getPostParameter('ContractProduct'))
        {    
            $this->form->bind($request->getPostParameter('ContractProduct'));
            if ($this->form->isValid())
            {
                $this->item->add($this->form->getValues());
                $this->item->save();
                $messages->addInfo(__("Product has been saved."));   
                $request->addRequestParameter('contract', $this->item->getContract());
                $this->forward('customers_contracts','ajaxListContractProduct');
            }   
            else 
            {
                $messages->addError(__("Form has some errors.")); 
                $this->item->add($request->getPostParameter('ContractProduct'));
            }
        }    
    }

}
