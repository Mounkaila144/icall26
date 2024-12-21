<?php


class UserSecurityForm extends mfForm {

    function configure() {       
        $this->setValidators(array(
            'code' => new mfValidatorInteger(),          
        ));        
        $this->validatorSchema->setPostValidator(new UserSecurityCodeValidator());
    }
}

class users_guard_security_code_loginAction extends mfAction {
    
     
    function execute(mfWebRequest $request) {       
        // If AJAX or File requested   
        if ($request->isXmlHttpRequest()||$request->getURIExtension()) {
            $this->getResponse()->setStatusCode(403);
            return mfView::HEADER_ONLY;
        }                    
        if (!$user=$this->getUser()->getStorage()->read('user'))
             $this->forwardTo401Action();
        $messages = mfMessages::getInstance();
        $this->form = new UserSecurityForm();        
        try {
            
            if ($request->isMethod('POST')) {
                $this->form->bind($request->getPostParameter('signin'));
                if ($this->form->isValid()) {                                         
                    $this->getUser()->signin($user,false);
                    $this->userAuthentified(); // On fait le reste au shutdown
                    $this->getUser()->getStorage()->remove('user');
                    UserSecurityCode::cleanUp($user);
                    // Go to the page requested     
                    $this->getEventDispather()->notify(new mfEvent($user, 'user.connected')); 
                    $this->redirect('/superadmin/');
                } 
                else
                {      
                    UserSecurityCode::updateNumber();
                    if (UserSecurityCode::isOver())
                    {                                              
                       UserSecurityCode::cleanUp($user);
                       $this->getUser()->getStorage()->remove('user');
                     /*  $this->getEventDispather()->notify(new mfEvent($this, 'user.failed.login', array('username'=>$user->get('username'),'password'=>'xxxxxxxxxxx','ip'=>$request->getIp()))); */
                       $this->redirect('/superadmin/');                    
                    }                      
                }
            }            
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }     
        $request->addRequestParameter('user', $this->getUser()->getStorage()->read('user'));
        $this->forward('users_guard', 'authentificationByCode');
    }
    
    protected function userAuthentified()
    {
        register_shutdown_function(array("users_guard_signinAction","shutdown"),$this->form->getValue('user'));
    }
    
    static function shutdown($user)
    {
      mfContext::getInstance()->getEventManager()->notify(new mfEvent($user, 'user.signin')); 
    }
}


