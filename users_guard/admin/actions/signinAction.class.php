<?php


class users_guard_signinAction extends mfAction {
    
     
    function execute(mfWebRequest $request) {
        if ($request->isXmlHttpRequest()||$request->getURIExtension()) {
            $this->getResponse()->setStatusCode(403);
            return mfView::HEADER_ONLY;
        }        
        $messages = mfMessages::getInstance();
        $this->form = new UserGuardForm();
        $this->time_out = $this->getUser()->getSessionExpired() ? $this->getUser()->getOption('timeout') : false;          
        try {
            
            if ($request->isMethod('POST')) 
            {
                $this->form->bind($request->getPostParameter('signin'));
                if ($this->form->isValid()) 
                {
                    $values = $this->form->getValues();
                    $this->getUser()->signin($values['user'],(isset($values['remember'])?$values['remember']:false));
                    // Go to the page requested         
                    $this->getEventDispather()->notify(new mfEvent($values['user'], 'user.connected')); 
                    $this->redirect($request->getReferer());
                } 
                else
                {                    
                    $this->getEventDispather()->notify(new mfEvent($this, 'user.failed.login', array_merge($request->getPostParameter('signin'),array('ip'=>$request->getIp()))));
                }    
            }
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }      
    }
    
   
}


