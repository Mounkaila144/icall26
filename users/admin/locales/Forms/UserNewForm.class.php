<?php

class UserNewForm extends UserBaseForm {
    
     protected $user=null,$settings=null;
            
     function __construct($user, $defaults = array(), $site = null) {
         $this->user=$user;
         $this->settings = UserSettings::load($site);
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
        if ($this->getUser()->hasCredential(array(array('superadmin','settings_users_new_all_groups'))) && !$this->getUser()->hasGroups(array('telepro_manager','sales_manager')) && !$this->getUser()->hasCredential(array(array('users_new_user_as_sales_manager','users_new_user_as_telepro_manager'))) )
        {                 
            $this->setValidator('functions',new mfValidatorChoice(array('key'=>true,'required'=>false,'multiple'=>true,'choices'=>UserFunctionBaseUtils::getFieldValuesForI18nSelect('value'))));
            $this->setValidator('groups',new mfValidatorChoice(array('key'=>true,'required'=>false,'multiple'=>true,'choices'=>GroupUtils::getGroups('admin'))));
        }
        else
        {            
            unset($this['team_id']);
        }    
        if ($this->getUser()->hasCredential(array(array('users_new_user_as_telepro_manager'))))
        {                       
           if ($this->hasValidator('team_id'))                         
               unset($this['team_id']);  
           if ($this->getSettings()->hasTeleproGroups() && $this->getSettings()->getTeleproGroups()->count() != 1)                        
               $this->setValidator('groups',new mfValidatorChoice(array('key'=>true,'required'=>false,'multiple'=>true,'choices'=>$this->getSettings()->getTeleproGroups()->toArray())));                      
           else
               unset($this['groups']);
           unset($this['functions']);         
        }          
        if ($this->getUser()->hasCredential(array(array('users_new_user_as_sales_manager'))))
        {                        
           if ($this->hasValidator('team_id'))                         
               unset($this['team_id']);                     
           if ($this->getSettings()->hasSaleGroups() && $this->getSettings()->getSaleGroups()->count() != 1)                                   
               $this->setValidator('groups',new mfValidatorChoice(array('key'=>true,'required'=>false,'multiple'=>true,'choices'=>$this->getSettings()->getSaleGroups()->toArray())));                                 
           else            
               unset($this['groups']);                      
           unset($this['functions']);  
        }          
        if ($this->getSettings()->hasCallCenter())       
            $this->setValidator("callcenter_id",new mfValidatorChoice(array("choices"=>array(""=>"")+Callcenter::getCallcenterForSelect(),"key"=>true,"required"=>false)));        
        unset($this['id'],$this['picture']);
        if ($this->getUser()->hasCredential(array(array('superadmin','settings_user_new_company'))))
        {
            $this->setValidator('company_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>CustomerContractCompany::getActiveCompaniesForSelect()->unshift(array(""=>__("Not defined"))))));       
        }        
        $this->validatorSchema->setPostValidator(new mfValidatorSchemaCompare('password', mfValidatorSchemaCompare::EQUAL, 'repassword',array(),array("invalid"=>__("password and repassword must be equal."))));
        if ($this->getDefault('password'))
            $this->repassword->setOption('required',true);
        $this->setValidator('is_secure_by_code',new mfValidatorBoolean(array('true'=>'YES','false'=>'NO')));

        
    }
    
    function getValues()
    {       
         $this->values['is_active']='YES';
        if ($this->getUser()->hasGroups(array('telepro_manager')) || $this->getUser()->hasCredential(array(array('users_new_user_as_telepro_manager'))))
        {           
            // Function
            $telepro_function=new UserFunction('TELEPRO');
            $this->values['functions']=array($telepro_function->get('id'));
            // Groups             
            if ($this->getSettings()->hasTeleproGroups() && $this->getSettings()->getTeleproGroups()->count() == 1)                    
               $this->values['groups']=array($this->getSettings()->getTeleproGroups()->getFirst()->get('id'));             
            // Team
            $team=$this->getUser()->getGuardUser()->getManagerTeam();
            if ($team)
                $this->values['team_id']=$team->get('id'); 
        }          
        if ($this->getUser()->hasGroups(array('sales_manager')) || $this->getUser()->hasCredential(array(array('users_new_user_as_sales_manager'))))
        {            
            // Function
            $sale_function=new UserFunction('SALES');
            $this->values['functions']=array($sale_function->get('id'));
            // Groups
            if ($this->getSettings()->hasSaleGroups() && $this->getSettings()->getSaleGroups()->count() == 1)                    
               $this->values['groups']=array($this->getSettings()->getSaleGroups()->getFirst()->get('id'));       
            // Team
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
}