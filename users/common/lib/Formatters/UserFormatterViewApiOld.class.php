<?php

class mfWidgetCollection extends mfArray {
        
    function pushIf($condition,$widget)
    {
        if ($condition)
            $this->push($widget->toArray());        
        return $this;
    }        
}

class mfWidget {
    
    protected $field=null,$parameters=null;
    
    function __construct($field,$parameters) {
        
        $this->field=$field;
        $this->parameters=$parameters;
    }
            
    function toArray()
    {
        $values=new mfArray($this->parameters);
        $values['name']= $this->field;        
        return $values->toArray();
    }
}

class UserFormatterViewApiOld {
   
    protected $user=null,$item=null,$form=null;
    
    function __construct($item,$form) {
        
        $this->item=$item;
        $this->form=$form;
        $this->user= mfcontext::getInstance()->getUser();
    }
    
    function getSettings()
    {
        
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function getItem()
    {
        return $this->item;
    }
    
    function getForm()
    {
        return $this->form;
    }
    
    function getData()
    {
        if ($this->data===null)
        {    
            $this->data = new mfWidgetCollection();  
            $this->data->pushIf($this->getUser()->hasCredential(array('superadmin')),new mfWidget('username',array(
                        'label'=>__('Username'),
                        'style'=>'border: ;color:;', // ?                    
                        'value'=>$this->getItem()->get('username'),
                        'schema'=> $this->getForm()->getFieldMapping('username')
                )));
            $this->data->pushIf($this->getUser()->hasCredential(array('superadmin')),new mfWidget('id',array(                   
                        'value'=>$this->getItem()->get('id'),
                        'schema'=> $this->getForm()->getFieldMapping('id')
                )));
        }
        return $this->data;
    }         
     
     
}
