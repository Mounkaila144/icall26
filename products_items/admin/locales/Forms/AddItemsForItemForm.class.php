<?php

class AddItemsForItemForm extends mfForm {
    
    protected $item=null;
    
    function __construct(ProductItem $item,$defaults = array(), $options = array()) {
        $this->item=$item;
        parent::__construct($defaults, $options);
    }    
   
    function getItem(){
        return $this->item;
    }
   
    function configure() {
        if (!$this->getDefaults())
        {    
            $this->setDefault('items', $this->getItem()->getItems()->BySlaves()->toArray());           
        }
        $this->setValidators(array(
            'items'=>new mfValidatorChoice(array('required'=>false,'key'=>true,'multiple'=>true,'choices'=>ProductItem::getItemsExcepted($this->getItem())))
        ));
        
    }
    
    function getItems(){
        return $this['items']->getArray();
    }
}

