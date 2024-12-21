<?php

class userGuard_loginActionComponent extends mfActionComponent {
            
    function execute(mfWebRequest $request) {        
        $messages = mfMessages::getInstance();       
        if ($this->getUser()->isAuthenticated())            
            $this->forward("/userGuard/authentified");       
        $this->form = new customerGuardForm();
        try {
                if ($request->isMethod('post')) {
                    $this->form->bind($request->getPostParameter('signin'));
                if ($this->form->isValid()) {
                    $values = $this->form->getValues();
                    $this->customer = $values['customer'];                    
                    $this->getUser()->signin($values['customer'], (isset($values['remember']) ? $values['remember'] : false));                                     
                    $this->getEventDispather()->notify(new mfEvent($this->getUser(), 'customer.authentified'));                    
                    $this->forward("/userGuard/authentified");                  
                }
            }
        } catch (mfException $e) {
            $messages->addError($e);
        }
    } 
    
    
}
