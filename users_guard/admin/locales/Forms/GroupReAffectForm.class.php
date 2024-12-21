<?php

class GroupReAffectForm extends mfForm {

    protected $group_from=null,$group=null;
    
    function __construct(Group $group,$defaults = array(), $options = array()) {
        $this->group_from=$group;
        parent::__construct($defaults, $options);
    }
    
    function getGroupFrom()
    {
        return $this->group_from;
    }
    
   function configure() { 
         $this->setValidators(array(            
             'group_id'=>new mfValidatorChoice(array('key'=>true,'choices'=>GroupUtils::getGroupsExceptedForSelect($this->getGroupFrom())->toArray()))
         ));
    }

    function getGroup()
    {
        if ($this->group===null)
        {
            $this->group=new Group($this['group_id']->getValue(),'admin');
        }   
        return $this->group;
    }
}