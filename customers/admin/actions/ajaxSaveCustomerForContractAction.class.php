<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerModifyForm.class.php";
 
class customers_ajaxSaveCustomerForContractAction extends mfAction {
    
    
    
        
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();
        $this->user=$this->getUser();
        $this->contract=new CustomerContract($request->getPostParameter('Contract')); 
        if ($this->contract->isNotloaded())
            return ;
        $this->form = new CustomerModifyForm($this->user,$request->getPostParameter('CustomerContract'));  
        if (!$request->isMethod('POST') || !$request->getPostParameter('CustomerContract'))
            return ;
        $this->form->bind($request->getPostParameter('CustomerContract'));  
        if ($this->form->isValid())
        {
            // Customer
            $this->contract->getCustomer()->add($this->form['customer']->getValues());
            $this->getEventDispather()->notify(new mfEvent( $this->contract->getCustomer(), 'customer.change',array('action'=>'update')));                                      
            $this->contract->getCustomer()->save();
            // Address
            $this->contract->getCustomer()->getAddress()->add($this->form['address']->getValues());
            if (!$this->contract->getCustomer()->getAddress()->calculateCoordinates())
                $messages->addWarning(__("GPS coordinates can not be calculated by GoogleMap : Address should be wrong."));
            $this->getEventDispather()->notify(new mfEvent( $this->contract->getCustomer()->getAddress(), 'customer.address.change',array('action'=>'update')));                                                  
            $this->contract->getCustomer()->getAddress()->save();                       
            $this->getEventDispather()->notify(new mfEvent( $this->contract, 'contract.customer.address',array('action'=>'update')));  
            $messages->addInfo("Customer has been saved.");               
            $this->forward('customers','ajaxViewCustomerForContract');
        }   
        else 
        {
             $messages->addError(__("Form has some errors.")); 
           //var_dump($this->form->getErrorSchema()-> getErrorsMessage());     
             $this->contract->getCustomer()->add($this->form['customer']->getValues());
             $this->contract->getCustomer()->getAddress()->add($this->form['address']->getValues());                
        }      
   }

}

