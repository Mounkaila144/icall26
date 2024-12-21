<?php




class customers_loginAction extends mfAction {
    
     
    function execute(mfWebRequest $request) {
        if ($request->isXmlHttpRequest()||$request->getURIExtension()) {
            $this->getResponse()->setStatusCode(403);
            return mfView::HEADER_ONLY;
        }  
        if ($this->getUser()->isAuthenticated() && $this->getUser()->isCustomerUser())
        {           
            $this->redirect(to_link_i18n(mfConfig::get('mf_customer_redirect_account')));            
        }       
        $messages = mfMessages::getInstance();
        $this->form = new CustomerUserGuardForm($request->getPostParameter('Login'));
     //   $this->time_out = $this->getUser()->getSessionExpired() ? $this->getUser()->getOption('timeout') : false;
        try 
        {
            
            if ($request->isMethod('POST') && $request->getPostParameter('Login')) 
            {
                $this->form->bind($request->getPostParameter('Login'));
                if ($this->form->isValid()) {
                    $values = $this->form->getValues();
                    $this->getUser()->signin($values['user'],$request->getIP(),$this->form->getRemember());
                    // Go to the page requested                           
                    $this->redirect(to_link_i18n(mfConfig::get('mf_customer_redirect_account')));    
                } 
                else 
                {
                    //var_dump($this->form->getErrorSchema()->getErrorsMessage());
                }    
            }
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
    }
    
   
}


