<?php


class ProductActionNewForm extends ProductActionBaseForm {
    
    protected $user=null;
    
    function __construct($defaults = array(),$user=null) {
        $this->user=$user;
        parent::__construct($defaults, array());
    }
   
    function getUser()
    {
        return $this->user;
    }
    
     function configure() {              
       parent::configure();
       unset($this['id']);       
     }
    
}

