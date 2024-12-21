<?php


class users_guard_activityActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {
       $this->user=$this->getUser(); 
       if (!$this->user->hasCredential(array(array('superadmin_debugX','user_activity'))))
           return mfView::NONE;  
       $this->user_settings= UserSettings::load();
    } 
    
    
}

