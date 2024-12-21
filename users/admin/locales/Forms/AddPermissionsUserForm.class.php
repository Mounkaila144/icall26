<?php

class AddPermissionsUserForm extends mfForm {

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
        if ($diff=userPermissionUtils::isPermissionsUserNotAllowed($values['group_id'],$values['selection'],$this->application,$this->site))
           throw new mfValidatorError($validator,__("permission(s) [%s] don't exist.",implode(",",$diff)));
        foreach ($values['selection'] as $index=>$item)
        {
            $values['permissions'][$index]['permission_id']=$item;
            $values['permissions'][$index]['user_id']=$values['user_id'];
        }   
        unset($values['selection']);
        return $values;
    }
}

