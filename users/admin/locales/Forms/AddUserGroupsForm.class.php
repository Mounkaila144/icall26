<?php

class AddUserGroupsForm extends mfForm {

    protected $user=null;
    
    function __construct($user,$defaults = array(),$application=null, $options = array()) {   
        $this->user=$user;
         if ($application!=null)
            $this->application=$application;
        parent::__construct($defaults, $options);
    }
    
    function getConnectedUser()
    {
        return $this->user;
    }
    
    function configure()
    {
       $this->setValidators(array(
           "selection"=>new mfValidatorSchemaForEach(new mfValidatorInteger(),$this->getDefault('selection')?count($this->getDefault('selection')):1),
           "user_id"=>new ObjectExistsValidator('User',array('application'=>'admin','key'=>false))
       )); 
       $this->validatorSchema->setPostValidator(new mfValidatorCallback(array('callback' => array($this, 'reorganize'))));
    }
    
    function reorganize($validator,$values)
    {
        if (!$groups=UserGroupUtils::isAuthorizedGroupsForSelectionByUser($this->getConnectedUser(),new mfArray($values['selection'])))
           throw new mfValidatorError($validator,__("Group(s) not authorized."));     
      //  if ($diff=UserGroupUtils::isGroupsUserNotAllowed($values['user_id'],$values['selection'],$this->application))
      //     throw new mfValidatorError($validator,__("group(s) [%s] don't exist.",implode(",",$diff)));
        foreach ($groups as $index=>$item)
        {
            $values['groups'][$index]['group_id']=$item;
            $values['groups'][$index]['user_id']=$values['user_id'];
            $values['groups'][$index]['is_active']='YES';
        }   
        unset($values['selection']);
        return $values;
    }
        
    
    function getUser()
    {
         if ($this->isValid())
             return $this['user_id']->getValue();
         return new User($this['user_id']->getValue(),'admin');
    }
}

