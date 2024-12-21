<?php


class users_guard_authentificationByCodeAction extends mfAction {
         
    function execute(mfWebRequest $request) {  
        if (!$request->getRequestParameter('user'))  
            $this->forwardTo401Action ();
        $messages = mfMessages::getInstance();                 
        try 
        {                                  
            $this->getEventDispather()->notify(new mfEvent($this, 'user.authentified'));             
            $this->getUser()->getStorage()->write('user',$request->getRequestParameter('user'));                        
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }              
    }
   
}


