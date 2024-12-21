<?php


class customers_accountCreatedAction extends mfAction {
    
     
    function execute(mfWebRequest $request) {       
                
        if (!$this->getUser()->isAuthenticated() || !$this->getUser()->isCustomerUser())             
            $this->redirect(to_link_i18n(mfConfig::get('mf_customer_redirect_signin')));
        $messages = mfMessages::getInstance();            
        if (!($steps=$this->getUser()->getStorage()->read('CustomerUserSteps')))
        {
           $steps=CustomerSettings::load()->get('steps'); 
           $this->getUser()->getStorage()->write('CustomerUserSteps',$steps);         
        }                  
        $steps->setCurrent($request->getParameter('route_full')->getRouteWithParameters());   
        if (!$steps->getCurrent()->isAuthorized())                 
            $this->redirect(to_link_i18n_to($steps->getPreviousAuthorized()->getRoute()));           
        // Submission
        if (!($subscription=$this->getUser()->getStorage()->read('CUSTOMER_USER_SUBSCRIPTION')))
        {        
             $subscription=new CustomerSubscription($this->getUser()->getGuardUser());                  
             $this->getUser()->getStorage()->write('CUSTOMER_USER_SUBSCRIPTION',$subscription);
        }
        $subscription->set('step',$steps->getCurrent()->get('name'));
        $subscription->save();           
        $this->getUser()->getStorage()->remove('CustomerUserSteps');
        $this->getUser()->getStorage()->remove('CUSTOMER_USER_SUBSCRIPTION');   
    }
    
   
}


