<?php

abstract class UserGuardSecurityBase extends UserGuardSecurityCore {
    
    abstract function isCustomerUser();
    
    
    
    public function signOut()
    {         
        $this->getAttributes()->removeNamespace('UserGuardSecurity');    
        if ($this->user)
            mfContext::getInstance()->getResponse()->setCookie(md5('Remember'.mfConfig::get('mf_app')), '', time() - $this->user->getExpirationAge());
        $this->user = null;
        $this->clearCredentials();
        $this->setAuthenticated(false);     
    }
    
    function logout()
    {
        $this->getGuardUser(); // load user if not
        parent::logout();
    }
    
    
  
}

