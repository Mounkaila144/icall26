<?php

class UserNewProfileForm extends UserBaseForm {
    
     protected $user=null,$settings=null;
            
     function __construct($user, $defaults = array(), $site = null) {
         $this->user=$user;
         $this->settings = new  UserSettings(null,$site);
         parent::__construct($user, $defaults, $site); 
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
        if ($this->getUser()->hasCredential(array(array('users_new_teams_with_default_team'))))
        {              
             $this->setValidator('team_id',new mfValidatorChoice(array('key'=>true,'choices'=>UserTeamUtils::getTeamsWithDefaultTeamForSelect())));
        }      
        if (!$this->getUser()->hasCredential(array(array('users_new_user_as_sales_manager','users_new_user_as_telepro_manager'))) )
        {                 
           $this->setValidator('profile_id',new mfValidatorChoice(array('key'=>true,'choices'=>UserProfile::getProfilesI18nForSelect()->toArray())));
        }
        else
        {            
            unset($this['team_id']);
        }    
        if ($this->getUser()->hasCredential(array(array('users_new_user_as_telepro_manager'))))
        {                       
            if ($this->hasValidator('team_id'))                         
                unset($this['team_id']);  
            if ($this->getSettings()->hasTeleproProfiles() && $this->getSettings()->getTeleproProfiles()->count() > 1)                        
               $this->setValidator('profile_id',new mfValidatorChoice(array('key'=>true,'choices'=>$this->getSettings()->getTeleproProfiles()->toArray())));                                         
        }          
        if ($this->getUser()->hasCredential(array(array('users_new_user_as_sales_manager'))))
        {                        
            if ($this->hasValidator('team_id'))                         
               unset($this['team_id']);  
           if ($this->getSettings()->hasSaleProfiles() && $this->getSettings()->getSaleProfiles()->count() > 1)                        
               $this->setValidator('profile_id',new mfValidatorChoice(array('key'=>true,'choices'=>$this->getSettings()->getSaleProfiles()->toArray())));                                          
        }          
        if ($this->getSettings()->hasCallCenter())       
            $this->setValidator("callcenter_id",new mfValidatorChoice(array("choices"=>array(""=>"")+Callcenter::getCallcenterForSelect(),"key"=>true,"required"=>false)));        
        unset($this['id'],$this['picture']);
        $this->validatorSchema->setPostValidator(new mfValidatorSchemaCompare('password', mfValidatorSchemaCompare::EQUAL, 'repassword',array(),array("invalid"=>__("password and repassword must be equal."))));
        if ($this->getDefault('password'))
            $this->repassword->setOption('required',true);
        if ($this->hasValidator('team_id'))
        {    
            $this->setValidator('team',new mfValidatorString(array('required'=>false)));             
            if ($this->getDefault('team')) 
            {    
                 $this->team_id->getOption('required',false);      
                 $this->team_id->getCHoices()->unshift(array('0'=>''));
            }
            $this->setValidator('manager_id',new mfValidatorChoice(array('key'=>true,'choices'=>array(0=>__("--- Not defined ---"),'me'=>__("--- In progress user ---"),""=>"")+UserUtils::getUsersByFunctionsForSelect(array('TELEPROMANAGER','SALEMANAGER')),'required'=>false)));               
        }
        if ($this->hasValidator('team_id') && $this->getUser()->hasCredential(array(array('superadmin','users_new_team_manager'))))
        {                
           $this->setValidator('is_team_manager',new mfValidatorBoolean(array()));                                         
        } 
        if ($this->getUser()->hasCredential(array(array('superadmin','settings_user_new_company'))))
        {
            $this->setValidator('company_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>CustomerContractCompany::getActiveCompaniesForSelect()->unshift(array(""=>__("Not defined"))))));       
        } 
        $this->setValidator('is_secure_by_code',new mfValidatorBoolean(array('true'=>'YES','false'=>'NO')));

    }
    
    function getValues()
    {               
        $this->values['is_active']='YES';        
        if ($this->getUser()->hasCredential(array(array('users_new_user_as_telepro_manager'))))
        {                             
            $team=$this->getUser()->getGuardUser()->getManagerTeam();
            if ($team)
                $this->values['team_id']=$team->get('id'); 
        }                      
        if ($this->getUser()->hasCredential(array(array('users_new_user_as_sales_manager'))))
        {                            
            $team=$this->getUser()->getGuardUser()->getManagerTeam();
            if ($team)
                $this->values['team_id']=$team->get('id'); 
        }    
        if ($this->getUser()->hasCredential(array(array('users_new_user_as_company_manager'))))
        {
            $this->values['company_id']=$this->getUser()->getGuardUser()->get('company_id');
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
    
    
    function isTeamManager()
    {
        if ($this->hasValidator('is_team_manager'))
            return $this['is_team_manager']->getValue();
        return false;
    }
    
    
    function getTeamByDefault()
    {
        if ($this->hasValidator('team_id') && $this->getSettings()->hasDefaultTeam())      
            return $this->getSettings()->getDefaultTeam();      
        return 0;
    }
}