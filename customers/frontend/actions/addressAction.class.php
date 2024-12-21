<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerUserAddressNewForm.class.php";

class customers_addressAction extends mfAction {
    
     
    function execute(mfWebRequest $request) {       
        if (!$this->getUser()->isAuthenticated() || !$this->getUser()->isCustomerUser())             
            $this->redirect(to_link_i18n(mfConfig::get('mf_customer_redirect_signin')));      
        if ($this->getUser()->getGuardUser()->isSubsripted())
            $this->redirect(link_i18n_to('customers_account'));
        $messages = mfMessages::getInstance(); 
        $steps=$this->getUser()->getStorage()->read('CustomerUserSteps');  
        if (!$steps)
        {
           $steps=CustomerSettings::load()->get('steps'); 
           $this->getUser()->getStorage()->write('CustomerUserSteps',$steps);         
        }    
        // Submission
        if (!($subscription=$this->getUser()->getStorage()->read('CUSTOMER_USER_SUBSCRIPTION')))
        {        
             $subscription=new CustomerSubscription($this->getUser()->getGuardUser());                  
             $this->getUser()->getStorage()->write('CUSTOMER_USER_SUBSCRIPTION',$subscription);
        }
        $steps->setCurrent($request->getParameter('route_full')->getRouteWithParameters());         
        $this->form=new CustomerUserAddressNewForm($request->getPostParameter('CustomerUserAddress'));
        $this->address=new CustomerUserAddress();
        $this->address->set('country',$this->form->getDefault('country'));
        $this->address->add(array('alias'=>__('My main address'),
                                  'address1'=>'810 rue du bois tison',
                                  'postcode'=>'76160',
                                  'city'=>'SAINT JACQUES SUR DARNETAL'
                           ));
        if (!$request->isMethod('POST') || !$request->getPostParameter('CustomerUserAddress'))       
            return ;
        $this->form->bind($request->getPostParameter('CustomerUserAddress'));
        if ($this->form->isValid())
        {
            $this->address->add($this->form->getValues());
            $this->address->set('user_id',$this->getUser()->getGuardUser());
            $this->address->set('is_default','YES');
            if (!$this->address->calculateCoordinates())
                $messages->addWarning(__("Coordinates have not been found"));
            $this->address->save();
            // User
            $this->address->getUser()->set('is_subscript','YES');
            $this->address->getUser()->save();
            // Subscription            
            $subscription->set('is_completed','YES');
            $subscription->set('step',$steps->getCurrent()->get('name'));
            $subscription->save();               
            $this->redirect(to_link_i18n($steps->getNext()->authorized()->getRoute()));          
        }   
        else
        {
           // var_dump($this->form->getErrorSchema()->getErrorsMessage());
            $this->address->add($request->getPostParameter('CustomerUserAddress'));
            $messages->addError(__("Form has some errors."));
        }    
                            
        
    }
    
   
}


