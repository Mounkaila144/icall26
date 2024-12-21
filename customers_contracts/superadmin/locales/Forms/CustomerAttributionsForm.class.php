<?php

class UserContributor extends mfFormSite {
    
    static $attributions=null;
    
    function __construct($defaults = array(),$site = null) {
         parent::__construct($defaults,  array(), $site);          
    }
    
    function configure()
    {                       
       if (!self::$attributions)
       {
            self::$attributions=UserAttributionUtils::getAttributionsForI18nSelect($this->getSite());
       }       
       $this->setValidators(array(                         
           'attribution_id'=>new mfValidatorChoice(array('key'=>true,'choices'=>array(0=>"")+self::$attributions)),              
       ));
    }
}


class Contributors extends mfFormSite  {
       
    function __construct($defaults = array(),$site = null) {
        parent::__construct($defaults,  array(), $site);       
    }
    
    function configure()
    {               
       foreach (array('telepro'=>'TELEPRO','sale_1'=>'SALES','sale_2'=>'SALES','manager'=>'SALEMANAGER') as $name=>$function)
       {
           $this->embedForm($name, new UserContributor($this->getDefault($name),$this->getSite()));
           $this->$name->addValidator('user_id',new mfValidatorChoice(array('key'=>true,'choices'=>array(0=>"")+UserFunctionUtils::getUsersByFunctionForSelect($function,$this->getSite()))));                   
       }               
    }
}


class CustomerAttributionsForm extends mfFormSite {
        
    function __construct($defaults = array(),$site = null) {
        parent::__construct($defaults,  array(), $site);
    }
    
    function configure()
    {                        
       $this->setValidators(array(
             'team_id'=>new mfValidatorChoice(array('key'=>true,'choices'=>array(0=>"")+UserTeamUtils::getFieldValuesForSelect('name',$this->getSite()))),                                      
       ));
       $this->embedForm('contributors', new Contributors($this->getDefault('contributors'),$this->getSite()));
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


