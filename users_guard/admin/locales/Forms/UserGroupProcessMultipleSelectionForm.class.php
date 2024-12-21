<?php

class UserGroupProcessMultipleSelectionForm extends mfForm {

    protected $user=null,$selection=null,$_collection=null;
    
    function __construct($user,$defaults = array(), $options = array()) {
        $this->user=$user;
        parent::__construct($defaults, $options);
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function configure() {                   
        
        $this->setValidators(array(
            'count'=>new mfValidatorInteger(),   
            'selection'=>new mfValidatorSchemaForEach(new mfValidatorInteger(),count($this->getDefault('selection')),array('required'=>false)),
        )); 
        $this->actions=new mfArray(array("delete_permissions","add_permissions"));
        $this->setValidator('actions', new mfValidatorChoice(array('required'=>false,'multiple'=>true,'choices'=>$this->actions)));
        $this->setValidator('delete_permissions',new mfValidatorMultipleString(array('required'=>false))); 
        $this->setValidator('add_permissions',new mfValidatorMultipleString(array('required'=>false))); 
    }
    
    function getActions()
    {
        return $this->actions;
    }
    
    function getActionValues()
    {
        return $this['actions']->getArray();
    }
   
    function setSelection($selection)
    {
        $this->setDefault('selection', $selection);
        $this->setDefault('count', count($selection));
    }

  
    function getSelectionForGroup($group_id)
    {
        $selection = $this->getValidator('group_id')->getOption("choices");
        unset($selection[$group_id]);
        return $selection;
    }
    
    function getSelection()
    {
        //if ($this->isValid())
            return $this['selection']->getArray();        
      //  return new mfArray();
    }
    
    function getCollection()
    {
        if ($this->_selection===null)
            $this->_selection = GroupUtils::getGroupsByIds($this->getSelection());
        return $this->_selection; 
    }
}