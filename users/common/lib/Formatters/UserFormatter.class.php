<?php


class UserFormatter extends mfFormatter {
   
    
    function getCreatedAt()
    {
        return new DateTimeFormatter($this->getValue()->get('created_at'));
    }
    
    function getUser()
    {
        return new mfString((string)$this->getValue());
    }
   
    function getLockedAt()
    {       
        return new DateTimeFormatter($this->getValue()->get('locked_at'));       
    }
    
    function getLastlogin()
    {       
        return new DateTimeFormatter($this->getValue()->get('lastlogin'));       
    }
    
    function isActive($true=true,$false=false)
    {
        $true= isset($parameters['true'])?is_array($parameters['true'])?implode(";",$parameters['true']):$parameters['true']:true;
        $false= isset($parameters['false'])?is_array($parameters['false'])?implode(";",$parameters['false']):$parameters['false']:false;
        return $this->getValue()->get('is_active')=='YES'?$true:$false;
    }
    
    function getTeamManagers()
    {
        if (!$this->getValue()->hasTeamManagers())
           return null;
        if ($this->getValue()->getTeamManagers()->isEmpty())
           return null;
        return $this->getValue()->getTeamManagers()->getManagerAndTeams();
    }
    
    function getProfile()
    {
         return $this->getValue()->getProfile()->get('profile_id');
    }
    
    function getFirstTeam()
    {
         return $this->getValue()->getTeams()->getKeys()->getFirst();
    }
    
     function getProfileI18n(){
        return $this->getValue()->getProfile()->getProfile()->getI18n();
    }
    
    function getGroupNames(){
        return implode(",", $this->getValue()->getGroupNames());
    }
    
    function getOutput($tpl=""){
            return $this->getUser();

    }
    
    function toArrayForApi2()
    {
        return $this->getValue()->toArray(['firstname','lastname','email','lastlogin','last_password_gen','username', 
                                   'mobile','callcenter_id','is_locked', 'locked_at', 'unlocked_by','number_of_try', 
                                   'creator_id','is_secure_by_code','company_id',
                                   'is_active','is_guess','created_at','updated_at','sex']);        
    }
}
