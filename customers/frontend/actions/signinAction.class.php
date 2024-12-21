<?php


require_once dirname(__FILE__)."/../locales/Forms/CustomerSigninForm.class.php";
require_once dirname(__FILE__)."/../locales/Forms/CreateProfileForm.class.php";

class customers_signinAction extends mfAction {
    
     
    function execute(mfWebRequest $request) {
        if ($request->isXmlHttpRequest()||$request->getURIExtension()) {
            $this->getResponse()->setStatusCode(403);
            return mfView::HEADER_ONLY;
        }  
        if ($this->getUser()->isAuthenticated() && $this->getUser()->isCustomerUser())                
            $this->redirect(to_link_i18n(mfConfig::get('mf_customer_redirect_account')));                    
        if ($this->getUser()->getStorage()->read('CUSTOMER_USER_SUBSCRIPTION'))              
            $this->forward('customers','SuccessSubscription');        
        $messages = mfMessages::getInstance();        
        $this->form = new CustomerSigninForm(array(
                        'email'=>'test@test.fr',
                        'password'=>'123',
                        'firstname'=>'adam',
                        'lastname'=>'mallet'
        ));            
        if ($request->isMethod('POST'))
        {
           $form=new CreateProfileForm(); 
           $form->bind($request->getPostParameter('CustomersSignin'));         
           if ($form->isValid())
           {            
               $this->form->setDefault('email',$form['email']->getValue());
           }    
          // else { echo "<pre>";  var_dump($form->getErrorSchema()->getErrorsMessage()); echo "</pre>"; }
        }                                 
    }
    
   
}


