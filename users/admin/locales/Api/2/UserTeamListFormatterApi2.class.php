<?php

class UserTeamListFormatterApi2 extends mfFormatterApi2 {
    
    protected $data=array(),$user=null;
    
    function __construct($user) {
        $this->user = $user;        
        parent::__construct();
    }        
    
    function getUser()
    {
        return $this->user;
    }
     
    function getSettings()
    {
        return $this->settings=$this->settings===null?new UserSettings():$this->settings;
    }
          
    function process()
    {        
        if (!$this->getUser()->hasCredential(array(array('superadmin','api2_settings_user_team_list'))))
              $this->forwardTo401Action();
        try 
        {                                 
             $this->data=UserTeamUtils::getFieldValues2ForSelect('name')->unshift(array(0=>__("No team")));
        }
        catch (mfException $e)
        {
            $this->data['errors']=$e->getMessage();
        }       
        return $this;
    }

}

