<?php

class UserViewProfileForm extends UserBaseForm {
    
     protected $user=null,$settings=null;
            
     function __construct(User $item,$user, $defaults = array(), $site = null) {
         $this->user=$user;
         $this->item=$item;
         $this->settings = UserSettings::load($site);
         parent::__construct($user, $defaults, $site); 
     }     
     
     function getItem()
     {
         return $this->item;
     }
     
     function getUser()
     {
         return $this->user;
     }
     
     function getSettings()
     {
         return $this->settings;
     }
     
     function configure() 
     {               
        parent::configure();                  
        $this->setValidator('password',new mfValidatorString(array('required'=>false)));
        $this->setValidator('repassword',new mfValidatorString(array('required'=>false)));    
        if ($this->getUser()->hasCredential(array(array('users_view_teams_with_default_team'))))
        {            
            $this->setValidator('team_id',new mfValidatorChoice(array('key'=>true,'choices'=>UserTeamUtils::getTeamsWithDefaultTeamForSelect())));
            $this->getItem()->set('team_id',$this->getSettings()->hasDefaultTeam()?$this->getSettings()->getDefaultTeam():0);
        }
        else
        {
            $this->setValidator('team_id',new mfValidatorChoice(array('key'=>true,'multiple'=>true,'choices'=>UserTeamUtils::getFieldValues2ForSelect('name')->unshift(array(0=>__("No team"))))));         
        }    
        if (!$this->getUser()->hasGroups(array('telepro_manager','sales_manager')) && !$this->getUser()->hasCredential(array(array('users_view_user_as_sales_manager','users_view_user_as_telepro_manager'))) )
        {                 
            $this->setValidator('profile_id',new mfValidatorChoice(array('key'=>true,'choices'=>UserProfile::getProfilesI18nForSelect()->toArray())));
        }
        else
        {            
            unset($this['team_id']);
        }          
        if ($this->getUser()->hasCredential(array(array('users_view_user_as_telepro_manager'))))
        {                       
           if ($this->hasValidator('team_id'))                         
               unset($this['team_id']);  
           if ($this->getSettings()->hasTeleproProfiles() && $this->getSettings()->getTeleproProfiles()->count() > 1)                        
               $this->setValidator('profile_id',new mfValidatorChoice(array('key'=>true,'choices'=>$this->getSettings()->getTeleproProfiles()->toArray())));                                                  
        }          
        if ($this->getUser()->hasCredential(array(array('users_view_user_as_sales_manager'))))
        {                        
           if ($this->hasValidator('team_id'))                         
               unset($this['team_id']);  
           if ($this->getSettings()->hasSaleProfiles() && $this->getSettings()->getSaleProfiles()->count() > 1)                        
               $this->setValidator('profile_id',new mfValidatorChoice(array('key'=>true,'choices'=>$this->getSettings()->getSaleProfiles()->toArray())));                                         
        }          
        if ($this->getUser()->hasCredential(array(array('users_view_team_from_manager_and_members'))))
        {
           $this->setValidator('team_id',new mfValidatorChoice(array('key'=>true,'multiple'=>true,'choices'=>$this->getUser()->getGuardUser()->getTeamsFromManagerAndMembers()->getNamesForSelect()->toArray())));   
        }
        if ($this->getUser()->hasCredential(array(array('users_view_team_from_telepro_manager','users_view_team_from_sale_manager'))))
        {
           $this->setValidator('team_id',new mfValidatorChoice(array('key'=>true,'multiple'=>true,'choices'=>$this->getUser()->getGuardUser()->getTeamsAsManager()->getNamesForSelect()->toArray())));   
        }
        if ($this->getSettings()->hasCallCenter())       
            $this->setValidator("callcenter_id",new mfValidatorChoice(array("choices"=>array(""=>"")+Callcenter::getCallcenterForSelect(),"key"=>true,"required"=>false)));        
        unset($this['picture']);
        $this->validatorSchema->setPostValidator(new mfValidatorSchemaCompare('password', mfValidatorSchemaCompare::EQUAL, 'repassword',array(),array("invalid"=>__("password and repassword must be equal."))));
        if ($this->getDefault('password'))
            $this->repassword->setOption('required',true);
         if ($this->hasValidator('team_id') && $this->getUser()->hasCredential(array(array('superadmin','users_view_team_manager'))))
        {                
           $this->setValidator('is_team_manager',new mfValidatorBoolean(array()));                                         
        }
        if ($this->getUser()->hasCredential(array(array('superadmin','settings_user_view_company'))))
        {
            $this->setValidator('company_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>CustomerContractCompany::getActiveCompaniesForSelect()->unshift(array(""=>__("Not defined"))))));       
        } 
        $this->setValidator('is_secure_by_code',new mfValidatorBoolean(array('true'=>'YES','false'=>'NO')));

    }
    
    function getValues()
    {                         
        if (!$this->hasValidator('team_id') && $this->getUser()->hasCredential(array(array('users_view_user_as_telepro_manager'))))
        {                           
            $team=$this->getUser()->getGuardUser()->getManagerTeam();
            if ($team)
                $this->values['team_id']=$team->get('id'); 
        }                      
        if (!$this->hasValidator('team_id') && $this->getUser()->hasCredential(array(array('users_view_user_as_sales_manager'))))
        {                 
            $team=$this->getUser()->getGuardUser()->getManagerTeam();
            if ($team)
                $this->values['team_id']=$team->get('id'); 
        }    
        return parent::getValues();      
    }
    
    
    function getProfile()
    {
        if ($this->profile===null)
        {
            if ($this->hasValidator('profile_id'))  
            {                
                    $this->profile=new UserProfile($this['profile_id']->getValue());
            }        
            elseif ($this->getUser()->hasCredential(array(array('users_new_user_as_telepro_manager'))))
            {                                 
                 if ($this->getSettings()->hasTeleproProfiles() && $this->getSettings()->getTeleproProfiles()->count() == 1)   
                 {    
                     if ($this->getSettings()->getTeleproProfiles()->getKeys()->getFirst())
                         $this->profile=new UserProfile($this->getSettings()->getTeleproProfiles()->getKeys()->getFirst());                 
                 }
            }
            elseif ($this->getUser()->hasCredential(array(array('users_new_user_as_sales_manager'))))
            {                      
                if ($this->getSettings()->hasSaleProfiles() && $this->getSettings()->getSaleProfiles()->count() == 1)    
                {    
                   if ($this->getSettings()->getSaleProfiles()->getKeys()->getFirst())
                    $this->profile=new UserProfile($this->getSettings()->getSaleProfiles()->getKeys()->getFirst());                
                }
            }           
        }   
        return $this->profile;
    }
    
    function getTeam()
    {
        if (!$this->hasValidator('team_id'))
            return null;
        return $this['team_id']->getArray();
    }
    
    
     function isTeamManager()
    {
        if ($this->hasValidator('is_team_manager'))
            return $this['is_team_manager']->getValue();
        return false;
    }
}