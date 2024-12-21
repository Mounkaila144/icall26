<?php

class UserGuardSecurity extends UserGuardSecurityBase {
    
    protected $user=null;
    
    function isCustomerUser()
    {
        if ($this->user==null)
            $this->getGuardUser();
        return (get_class($this->user)=='CustomerUser');
    }
       
    
    public function signIn($user,$ip,$remember=false)
    {        
        $this->user=$user;
        $this->setAuthenticated(true);           
        $this->setAttribute('User', $user, 'UserGuardSecurity');    
        $this->clearCredentials();   
        if (method_exists($user, 'getAllPermissionNames'))
            $this->addCredentials($user->getAllPermissionNames());  
        // Groups
        $this->clearGroups(); 
        if (method_exists($user, 'getGroupNames'))
            $this->addGroups($user->getGroupNames());  
        $user->set('lastlogin',date('Y-m-d H:i:s'));
        $user->set('is_connected','YES');        
        $user->save();                
        $this->user->updateSession($this,session_id(),$ip);
        if ($remember)
        {             
           $remember_user= $this->user->updateRememberMe($ip);          
           mfContext::getInstance()->getResponse()->setCookie($remember_user->getCookieName(), $remember_user->get('key'),$remember_user->get('expiration_time'));
        }      
    }
    
    function reloadUser($user)
    {
        $this->user=$user;
        $this->setAttribute('User', $user, 'UserGuardSecurity');    
        return $this->user;
    }
    
    function getGuardUser()
    {
       if (!$this->user && $user = $this->getAttribute('User', 'UserGuardSecurity')) {
            $this->user=$user; 
            if ($this->user->isLoaded())
                $this->user->updateSession($this,session_id());                           
            else    
                $this->signOut(); // the user does not exist anymore in the database
                
        }
      return $this->user;
    }
    
    function getClassUser()
    {
        return get_class($this->getGuardUser());
    }
    
    /* Profiles */
//    function hasProfiles()
//    {
//        return (boolean)$this->getStorage()->read('profiles');       
//    }
//    
//    function getProfiles()
//    {
//       return $this->getStorage()->read('profiles');       
//    }
//  
//    function setProfiles($profiles)
//    {
//        $this->getStorage()->write('profiles',$profiles);
//        return $this;
//    }
//    
//    function removeProfiles()
//    {
//        $this->getStorage()->remove('profiles');
//        return $this; 
//    }
    /* Profiles END */
}

