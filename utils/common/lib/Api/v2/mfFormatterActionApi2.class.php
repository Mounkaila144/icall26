<?php

abstract class mfFormatterActionApi2 extends mfFormatterApi2 {
            
     protected $data=array(),$user=null,$action=null;
     
     function __construct($action) {        
        $this->user = mfcontext::getInstance()->getUser();        
        $this->action=$action;         
        parent::__construct(); 
    }
    
    function getUser()
    {
        return $this->user;
    }   
    function getAction()
    {        
        return $this->action;
    }   
        
  
}
