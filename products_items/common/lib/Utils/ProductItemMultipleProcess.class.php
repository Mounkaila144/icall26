<?php

class ProductItemMultipleProcess {
   
    protected $site=null,$actions=null,$selection=null,$parameters=null,$messages=array(),$user=null,$errors=null;
    
    function __construct($actions,$selection,$parameters=array(),$user,$site=null) {
        $this->site=$site;
        $this->actions=$actions;
        $this->selection=$selection;
        $this->parameters=$parameters;
        $this->user=$user;
        $this->errors=new mfArray();
        $this->messages=new mfArray();
    }
    
    function getActions()
    {
        return $this->actions;
    }
    
    function getSite()
    {
        return $this->site;
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function getSelection()
    {
        return $this->selection;
    }
    
    function process()
    {                                    
        if (in_array('update_price_item_from_product',$this->getActions()))
        {                           
            ProductItem::updatePriceFromProduct($this->getSelection(),$this->getSite());  
            $this->messages[]=__("Item price has been updated as product.");
        }      
         if (in_array('update_discount_price_item_from_product',$this->getActions()))
        {                           
            ProductItem::updateDiscountPriceFromProduct($this->getSelection(),$this->getSite());  
            $this->messages[]=__("Item discount price has been updated as product.");
        }                 
        return $this;
    }
    
    function getMessages()
    {
        return $this->messages;
    }
    
    function getParameters()
    {
        return $this->parameters;
    }
    
    function getParameter($name,$default=null)
    {
        return isset($this->parameters[$name])?$this->parameters[$name]:$default;
    }        
    
     function getErrors()
    {
        return $this->errors;
    }
    
    function hasErrors()
    {
        return !$this->errors->isEmpty();
    }
    
    function addErrors(mfArray $errors)
    {
        $this->errors->merge($errors);        
        return $this;
    }
    
    function addMessage($message)
    {
        $this->messages[]=$message;
        return $this;
    }
}

