<?php

class AddUserGroupsForm extends mfForm {

    function __construct($defaults = array(),$application=null, $site=null,$options = array()) {
        if ($site!=null)
            $this->site=$site;
         if ($application!=null)
            $this->application=$application;
        parent::__construct($defaults, $options);
    }
    
    function configure()
    {
       $this->setValidators(array(
           "selection"=>new mfValidatorSchemaForEach(new mfValidatorInteger(),count($this->getDefault('selection'))),
           "user_id"=>new mfValidatorInteger()
       )); 
       $this->validatorSchema->setPostValidator(new mfValidatorCallback(array('callback' => array($this, 'reorganize'))));
    }
    
    function reorganize($validator,$values)
    {
        
        if ($diff=UserGroupUtils::isGroupsUserNotAllowed($values['user_id'],$values['selection'],$this->application,$this->site))
           throw new mfValidatorError($validator,__("group(s) [%s] don't exist.",implode(",",$diff)));
        foreach ($values['selection'] as $index=>$item)
        {
            $values['groups'][$index]['group_id']=$item;
            $values['groups'][$index]['user_id']=$values['user_id'];
            $values['groups'][$index]['is_active']='YES';
        }   
        unset($values['selection']);
        return $values;
    }
}

