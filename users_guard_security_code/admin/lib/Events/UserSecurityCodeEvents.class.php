<?php


class UserSecurityCodeEvents {
    
    static function setUserAuthentified(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('users_guard_security_code'))
             return ;        
        $action=$event->getSubject();      
        if ($action->getUser()->getStorage()->read('user'))
            return ;
        $engine=new UserSecurityCodeEmailEngine($action->getRequest()->getRequestParameter('user'));
        $engine->sendCode();
    }
    
}
