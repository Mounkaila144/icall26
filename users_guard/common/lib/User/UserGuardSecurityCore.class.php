<?php

class UserGuardSecurityCore extends mfBasicSecurityUser {
    
    const GROUPS_NAMESPACE = 'system/user/mfUser/groups';
    const FUNCTIONS_NAMESPACE = 'system/user/mfUser/functions';
    protected $user=null,$groups=array(),$functions=array(),$location=null;
  
    public function initialize(mfStorage $storage, $options = array())
    {
        parent::initialize($storage, $options);
        $this->groups   = $storage->read(self::GROUPS_NAMESPACE);
        $this->functions   = $storage->read(self::FUNCTIONS_NAMESPACE);
    }
   
    public function signIn(User $user,$remember=false)
    { 
        $this->setAuthenticated(true);       
        $this->setAttribute('user_id', $user->getId(), 'userGuardSecurity');
        //   $this->setAttribute('user', $user, 'userGuardSecurity');
        // Permissions
        $this->clearCredentials();   
        $this->addCredentials($user->getAllPermissionNames());  
        // Groups
        $this->clearGroups(); 
        $this->addGroups($user->getGroupNames());
        // Functions
        $this->clearFunctions(); 
        $this->addFunctions($user->getFunctionNames());
        $user->setLastLogin(date('Y-m-d H:i:s'));
        $user->save();  
        // var_dump($user,$this);  die(__METHOD__);
        $ip=mfContext::getInstance()->getRequest()->getIP();    
        $session=new Session(session_id());
        $session->add(array("last_time"=>date('Y-m-d H:i:s'),
                            "ip"=>$ip,
                            "user_id"=>$user->getId()));
        $session->save();
        
      
        if ($remember)
        {    
            $expiration_age = 15 * 24 * 3600; // 15 days
            // Cleanup en temps et user
            UserRememberUtils::cleanup(date('Y-m-d H:i:s', time() - $expiration_age), $user);
            $key = $this->generateRandomKey();
            $r=new UserRemember();
            $r->add(array('key'=>$key,'user_id'=>$user->getId(),'ip'=>$ip));
            $r->save();          
            mfContext::getInstance()->getResponse()->setCookie(md5('Remember'.mfConfig::get('mf_app')), $key, time() + $expiration_age);
        }  
    }
     
    function getGuardUser()
    {      
        if (!$this->user && $id = $this->getAttribute('user_id', 'userGuardSecurity')) {
            $this->user=new User($id); 
                        
            if ($this->user->isLoaded()) {                                   
                $session=new Session(session_id());                 
                $session->setLastTime(date('Y-m-d H:i:s'));
                if ($session->isNotLoaded())
                    $session->set('user_id',$this->user);
                $session->save();
            }
            else    
                $this->signOut(); // the user does not exist anymore in the database

        }
        return $this->user;
    }
  
    public function signOut()
    {
        $this->getAttributes()->removeNamespace('userGuardSecurity');
        $this->user = null;
        $this->clearCredentials();
        $this->setAuthenticated(false);  
        $this->getStorage()->regenerate(true); // Remove session
        $expiration_age = 15 * 24 * 3600;        
        mfContext::getInstance()->getResponse()->setCookie(md5('Remember'.mfConfig::get('mf_app')), '', time() - $expiration_age);     
    }


    protected function generateRandomKey($len = 20)
    {
        return base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
    }

    function addGroups($groups)
    {
       $this->groups=$groups; 
    }  

    function clearGroups()
    {
      $this->groups=array();  
    }

    function hasGroup($group)
    {
        return in_array($group,$this->groups);
    }

    function getGroups()
    {
        return $this->groups;
    }

    function hasGroups($groups)
    {
        foreach ((array)$groups as $group)
        {    
            if (in_array($group,$this->groups))
                return true;
        }
        return false;
    }

    function addFunctions($functions)
    {
       $this->functions=$functions; 
    }

    function clearFunctions()
    {
      $this->functions=array();  
    }

    function hasFunctions($functions)
    {
        foreach ((array)$functions as $function)
        {          
            if (in_array($function,$this->functions))
                return true;
        }
        return false;
    }

    function getFunctions()
    {
        return $this->functions;
    }

    function shutdown() {
        $this->storage->write(self::GROUPS_NAMESPACE,   $this->groups);
        $this->storage->write(self::FUNCTIONS_NAMESPACE,   $this->functions);    
        parent::shutdown();        
    }


    function logout()
    {
        $this->signout();     
        $this->shutdown();       
        return $this;
    }

    public function signInBySession($session_id)
    {        
       $session=UserGuardUtils::findByUserBySession($session_id);
        if ($session===null)
            return ;      
        $this->setAuthenticated(true);    
        session_id($session->get('session'));
        $this->setAttribute('user_id', $session->getUser()->getId(), 'userGuardSecurity'); 
        // Permissions
        $this->clearCredentials();   
        $this->addCredentials($session->getUser()->getAllPermissionNames());  
        // Groups
        $this->clearGroups(); 
        $this->addGroups($session->getUser()->getGroupNames());
        // Functions
        $this->clearFunctions(); 
        $this->addFunctions($session->getUser()->getFunctionNames());
        $session->getUser()->setLastLogin(date('Y-m-d H:i:s'));
        $session->getUser()->save();  
        // var_dump($user,$this);  die(__METHOD__);
        $ip=mfContext::getInstance()->getRequest()->getIP();
        // $session=new Session(session_id());
        $session->set("last_time",date('Y-m-d H:i:s'));
        $session->save();          
    }
  
    
    
    
    function setLocation($location)
    {            
        $this->location=($location===false)?false:new GPSCoordinate($location);      
        $this->setAttribute('location', $this->location, 'GeoLocation');    
    }

    function getLocation()
    {
        if ($this->location===null)
            $this->location=$this->getAttribute('location', 'GeoLocation');
        return $this->location;
    }

    function hasLocation()
    {
        $this->getLocation();
        return (boolean)$this->location;
    }
    
    function getSessionId()
    {
        return session_id();
    }
}

