<?php

require_once dirname(__FILE__)."/../locales/Forms/ContractSaleForm.class.php";


class customers_contracts_ajaxSmsContractForSaleAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");                      
        $this->item=new CustomerContract($request->getPostParameter('Contract'),$this->site);   
        $this->form=new ContractSaleForm();
        $this->form->bind($request->getPostParameter('ContractSaleSMS'));
        if ($this->form->isValid())
        {
            $this->user=($this->form['sale']->getValue()=='Sale1')?$this->item->getSale1():$this->item->getSale2();
            if (!$this->user->get('mobile'))
                  $messages->addWarning(__("Mobile doesn't exist, you have to complete it."));            
        }        
    }

}
