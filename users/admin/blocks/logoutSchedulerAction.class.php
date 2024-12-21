<?php


class users_logoutSchedulerActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {
       $this->user=$this->getUser(); 
       if (!$this->user->hasCredential(array(array('user_logout_scheduler'))))
           return mfView::NONE;  
       $this->user_settings= UserSettings::load();
    } 
    
    
}

