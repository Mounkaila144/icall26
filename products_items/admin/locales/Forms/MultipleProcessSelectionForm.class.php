<?php



class MultipleProcessSelectionForm extends mfForm {

    protected $user=null,$selection=null,$_actions=null;
    
    function __construct($user,$defaults = array(), $options = array()) {
        $this->user=$user;
        parent::__construct($defaults, $options);
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function configure() {           
        $this->_actions=new mfArray();
        $settings=  CustomerContractSettings::load();
        if (!$this->hasDefaults())
        {    
            $this->setDefaults(array(
               
            ));
        }
        $this->setValidators(array(
            'count'=>new mfValidatorInteger(),   
            'selection'=>new mfValidatorSchemaForEach(new mfValidatorInteger(),count($this->getDefault('selection'))),            
        ));             
        $this->_actions->push('update_price_item_from_product');        
        $this->_actions->push('update_discount_price_item_from_product');    
        $this->setValidator('actions', new mfValidatorChoice(array('required'=>false,'multiple'=>true,'choices'=>$this->_actions->toArray())));
    }
    
    function getActions()
    {
        return $this->_actions;
    }
    
    
    function getSelection()
    {
        if ($this->selection===null)
            $this->selection=new mfArray($this['selection']->getValue());
        return $this->selection;
    }
       
    function getSelectionCount()
    {
        return count($this['selection']->getValue());
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
    
    function hasActions()
    {           
        return $this['actions']->getValue();
    }
      
    function hasActionInValidator($action)
    {
        return in_array($action,$this->actions->getOption('choices'));
    }
        
}