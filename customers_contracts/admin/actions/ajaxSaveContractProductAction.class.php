<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractProductViewForm.class.php";



class customers_contracts_ajaxSaveContractProductAction extends mfAction {
    
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                           
        $this->user=$this->getUser();
        $this->item=new  CustomerContractProduct($request->getPostParameter('ContractProduct'));  
        if ($this->item->isNotLoaded())
            return ;
        $this->form=new CustomerContractProductViewForm($request->getPostParameter('ContractProduct'),$this->user); 
        if ($request->isMethod('POST') && $request->getPostParameter('ContractProduct'))
        {    
            $this->form->bind($request->getPostParameter('ContractProduct'));
            if ($this->form->isValid())
            {
                $this->item->add($this->form->getValues());
                //var_dump($this->form->getValues());
                if (!$this->item->hasTax())
                    $this->item->set('tva_id',$this->item->getProduct()->get('tva_id'));        
                $this->item->calculate();
                $this->item->save();
                $messages->addInfo(__("Product has been saved."));   
                $request->addRequestParameter('contract', $this->item->getContract());
                $this->forward('customers_contracts','ajaxListContractProduct');
            }   
            else 
            {
                $messages->addError(__("Form has some errors.")); 
                $this->item->add($request->getPostParameter('ContractProduct'));
              //  var_dump($this->form->getErrorSchema()->getErrorsMessage());
            }
        }    
    }

}
