<?php


class users_guard_userActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {
       $this->user=$this->context->getUser(); 
       $this->session=SessionUtils::getUserLastConnexion($this->user->getGuardUser());
       $this->time_out=(strtotime($this->user->getGuardUser()->get('lastlogin'))+$this->user->getOption('timeout')-60*5)-time();     
    } 
    
    
}

