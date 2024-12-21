<?php

class UserContributor extends mfForm {
    
    static $attributions=null;
           
    function configure()
    {                       
       if (!self::$attributions)       
            self::$attributions=UserAttributionUtils::getAttributionsForI18nSelect();       
       $this->setValidators(array(                                   
           'attribution_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(0=>"")+self::$attributions)),   
           'payment_at'=>new mfValidatorI18nDate(array('required'=>false,'date_format'=>'a'))
       ));
    }
}

class AttributionsMultipleForm extends mfForm {
    
     protected $user=null,$_selection=null;
    
   function __construct($user,$selection,$defaults = array(), $options = array()) {
       $this->_selection=$selection;
       $this->user=$user;     
       parent::__construct($defaults, $options);
   }
   
   function getUser()
   {
       return $this->user;
   }     
   
   /*function inAction($action)
   {
       return $this['actions']->getArray()->in($action);
   }*/
   
   function getActions()
   {
       return $this['actions']->getArray();
   }
   
   function getSelection()
   {
       if ($this->_selection===null)
         return $this['selection']->getArray();
       return $this->_selection;
   }
   
    function configure()
    {
        $this->setValidator('selection',new mfValidatorSchemaForEach(new mfValidatorInteger(),count($this->getDefault('selection'))));
        $this->setValidator('count',new mfValidatorInteger());
        foreach ($this->getTypes() as $name=>$functions)
       {                         
           if ($name!='team')           
           {    
                if ($this->getUser()->hasCredential(array(array('superadmin','contract_multiple_attributions_'.$name))))
                    $users=UserFunctionUtils::getUsersByFunctionsForAdminForSelect2($functions);
                else
                    $users=UserFunctionUtils::getUsersByFunctionsByTeamForUserForSelect2($this->getUser()->getGuardUser(),$functions);        
                if ($users->isEmpty())        
                    continue;                   
           }          
           $this->embedForm($name, new UserContributor($this->getDefault($name)));
           if ($name=='team')
           {
               if ($this->getUser()->hasCredential(array(array('superadmin','contract_multiple_attributions_team'))))
                    $this->$name->addValidator('team_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>UserTeamUtils::getFieldValuesForSelect2('name')->unshift(array(""=>__("No team"))))));
           }
           else
           {
               if ($this->getUser()->hasCredential(array(array('superadmin','contract_multiple_attributions_'.$name))))
                    $this->$name->addValidator('user_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("No ".$name))+$users->toArray())));                   
           }
       } 
         $this->setValidator('actions',new mfValidatorChoice(array('required'=>false,'multiple'=>true,'choices'=>$this->getTypes()->getKeys())));
    }
    
    function getValidatorByType($type,$field)
     {
          return isset($this->{$type}[$field])?$this->{$type}[$field]:null;
     } 
     
    function getTypes()
    {
        if ($this->types===null)
        {
           $this->types=new mfArray(array('team'=>'TEAM','assistant'=>'ASSISTANT','telepro'=>'TELEPRO','sale1'=>'SALES','sale2'=>'SALES','manager'=>array('SALEMANAGER','TELEPROMANAGER')));
        }   
        return $this->types;
    }
    
   /* function getValues()
    {
        $values=new mfArray();
        foreach ($this->getTypes()->getKeys() as $type)
        {
            if (!$this->hasValidator($type))
                continue;
            
        }    
        return $values;
    }*/
}