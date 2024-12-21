<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerModifyForm.class.php";
 
class customers_ajaxSaveCustomerForContractAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
        
    function execute(mfWebRequest $request) {              
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);    
        $this->forwardIf(!$this->site,"sites","Admin");
        $messages = mfMessages::getInstance();
        $this->contract=new CustomerContract($request->getPostParameter('Contract'),$this->site); 
        if ($this->contract->isNotloaded())
            return ;
        $this->form = new CustomerModifyForm();  
        if ($request->isMethod('POST') && $request->getPostParameter('CustomerContract'))
        {
            $this->form->bind($request->getPostParameter('CustomerContract'));  
            if ($this->form->isValid())
            {
                // Customer
                $this->contract->getCustomer()->add($this->form['customer']->getValues());
                $this->contract->getCustomer()->save();
                // Address
                $this->contract->getCustomer()->getAddress()->add($this->form['address']->getValues());
                $this->contract->getCustomer()->getAddress()->save();
                $messages->addInfo("Customer has been saved.");               
                $this->forward('customers','ajaxViewCustomerForContract');
            }   
            else 
            {
                 $messages->addError("form has some errors."); 
               //  var_dump($this->form->getErrorSchema()-> getErrorsMessage());
                 $this->contract->getCustomer()->add($this->form['customer']->getValues());
                 $this->contract->getCustomer()->getAddress()->add($this->form['address']->getValues());
            }
        }    
   }

}

