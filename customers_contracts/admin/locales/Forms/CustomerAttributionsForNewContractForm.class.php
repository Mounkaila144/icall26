<?php

class UserContributor extends mfForm {
    
    static $attributions=null;
           
    function configure()
    {                       
       if (!self::$attributions)
       {
            self::$attributions=UserAttributionUtils::getAttributionsForI18nSelect();
       }       
       $this->setValidators(array(                         
           'attribution_id'=>new mfValidatorChoice(array('key'=>true,'choices'=>array(0=>"")+self::$attributions)),              
       ));
    }
}


class ContributorsForm extends mfForm  {
    
   protected $user=null;
    
   function __construct($user,$defaults = array(), $options = array()) {
       $this->user=$user;      
       parent::__construct($defaults, $options);
   }
   
   function getUser()
   {
       return $this->user;
   }
   
    
     function configure()
    {            
       $settings=  CustomerContractSettings::load();
       $contributors=array();              
        if ($this->getUser()->hasCredential(array(array('superadmin','admin','contract_attributions_modify_telepro'))))
                $contributors['telepro']='TELEPRO';
        if ($this->getUser()->hasCredential(array(array('superadmin','admin','contract_attributions_modify_sale1'))))
                $contributors['sale_1']='SALES';
        if ($this->getUser()->hasCredential(array(array('superadmin','admin','contract_attributions_modify_sale2'))))
                $contributors['sale_2']='SALES';
        if ($this->getUser()->hasCredential(array(array('superadmin','admin','contract_attributions_modify_managers'))))
                $contributors['manager']=array('SALEMANAGER','TELEPROMANAGER');      
        if ($settings->hasAssistant() && $this->getUser()->hasCredential(array(array('superadmin','admin','contract_attributions_modify_assistant'))))
            $contributors['assistant']='ASSISTANT';           
       foreach ($contributors as $name=>$functions)
       {          
           if ($this->getUser()->hasCredential(array(array('superadmin','admin','contract_attributions_modify_all_users_as_'.$name))))
               $users=UserFunctionUtils::getUsersByFunctionsForAdminForSelect($functions);
           else
               $users=UserFunctionUtils::getUsersByFunctionsByTeamForUserForSelect($this->getUser()->getGuardUser(),$functions);        
           if ($users->isEmpty())        
               continue;                   
           $this->embedForm($name, new UserContributor($this->getDefault($name)));
           $this->$name->addValidator('user_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("No ".$name))+$users->toArray())));                   
       }               
    }
}


class CustomerAttributionsForNewContractForm extends mfForm {
       
    protected $user=null;
    
   function __construct($user,$defaults = array(), $options = array()) {    
       $this->user=$user;  
       parent::__construct($defaults, $options);
   }
   
   function getUser()
   {
       return $this->user;
   }   
   
    function configure()
    {             
            if (!$this->getUser()->hasCredential(array(array('contract_attributions_modify_no_team'))) )
            {        
             $this->setValidators(array(
                   'team_id'=>new mfValidatorChoice(array('key'=>true,'choices'=>array(0=>"")+UserTeamUtils::getFieldValuesForSelect('name'))),                                      
             ));
            }      
       $this->embedForm('contributors', new ContributorsForm($this->getUser(),$this->getDefault('contributors')));       
    }
    
 
     function getContributor($function)
     {
         $contributors=$this->getValue('contributors');
         return isset($contributors[$function])?$contributors[$function]:null;
     } 
     
     function hasContributor($function)
     {
         $contributors=$this->getValue('contributors');
         return isset($contributors[$function]);
     } 
}


