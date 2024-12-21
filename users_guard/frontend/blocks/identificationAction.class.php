<?php

class userGuard_identificationActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request) {      
       $messages = mfMessages::getInstance();         
        $this->customer=$this->getUser()->getGuardCustomer();            
        $this->form = new CustomerGuardForm();
        try 
        {
                if ($request->isMethod('post')) 
                {
                    $this->form->bind($request->getPostParameter('signin'));
                    if ($this->form->isValid()) {
                        $values = $this->form->getValues();
                        $this->customer = $values['customer'];                    
                        $this->getUser()->signin($values['customer'], (isset($values['remember']) ? $values['remember'] : false));                                     
                        $this->getEventDispather()->notify(new mfEvent($this->getUser(), 'customer.authentified'));                                                                       
                    }
                }
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
    } 
    
    
}
