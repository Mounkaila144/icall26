<?php

class UserFormatterApi   {
    
    protected $data=array();
    
    function __construct(User $item) {      
         $this->item=$item;   
         $this->user= mfcontext::getInstance()->getUser();         
         $this->process();
    }
    
    function getItem()
    {
        return $this->item;
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function process()
    {
        $this->data=$this->getItem()->toArray(array('id','email','firstname','lastname'));
        $this->data['created_at']=array('value'=>(string)$this->getItem()->getFormatter()->getCreatedAt()->getFormatted(),'style'=>'border-color:red');        
        return $this;
    }
       
    function toArray()
    {
        return $this->data;                       
    }
}
