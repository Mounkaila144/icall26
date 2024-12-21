<?php

class TransferGroupValidatorForm extends mfForm {      
    
    function configure() {           

        $this->setValidators(array(
            'group_dst_id'=>new mfValidatorInteger(),   
            'group_src_id'=>new mfValidatorInteger(),            
        ));     
    }
}

class UserGroupAffectationProcessMultipleSelectionForm extends mfForm {

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
        $this->actions=new mfArray(array("transfer"));
        $this->setValidator('actions', new mfValidatorChoice(array('required'=>false,'multiple'=>true,'choices'=>$this->actions)));
        $this->setValidator('group_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=> GroupUtils::getGroups('admin'))));
        $this->embedFormForEach("collection", new TransferGroupValidatorForm(), $this->getDefault('count'));
        
    }
    
    function getActions()
    {
        return $this->actions;
    }
   
    function setSelection($selection)
    {
        $this->setDefault('selection', $selection);
        $this->setDefault('count', count($selection));
    }

    function hasAction($action)
    {
        return in_array($action,(array)$this['actions']->getValue());
    }     
    
    function getSelectionForGroup($group_id)
    {
        $selection = $this->getValidator('group_id')->getOption("choices");
        unset($selection[$group_id]);
        return $selection;
    }
    
    function getSelection()
    {
        if ($this->_selection===null)
            $this->_selection = GroupUtils::getGroupsByIds(new mfArray($this['selection']->getValue()));
        return $this->_selection;
    }
    
    
    function getCollection()
    {
        if ($this->_collection===null)
            $this->_collection=new mfArray($this['collection']->getValue());
        return $this->_collection;
    }
           
    
    function setCollection($collection)
    {
        $this->setDefault('collection', $collection);
        $this->setDefault('count', count($collection));
    }
    
    function getCollectionForUrl()
    {       
        return http_build_query(array('collection'=>$this->getCollection()->implode()));
    }

}