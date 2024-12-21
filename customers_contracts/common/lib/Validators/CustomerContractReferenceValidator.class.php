<?php

class CustomerContractReferenceValidator extends mfValidatorString {

  
    protected function configure($options,$messages)
    { 
       parent::configure($options,$messages);
       $this->addOption('reference',true);
       $this->addMessage('notexist', __("record ({value}) doesn't exists."));
    }
  
    protected function doIsValid($value) 
    {               
        $item=new CustomerContract(array('reference'=>$value));      
        if ($item->isNotLoaded())
        {
           if (!$value=="" || $value=="0")
           {
               if ($this->getOption('required')==true)
                   throw new mfValidatorError($this, 'required');   
                 if ($this->getOption('reference'))
                   return $item->get('reference');    
               return $item;
           }   
           throw new mfValidatorError($this, 'notexist', array('value' => $value));
        }         
        if ($this->getOption('reference'))
                   return $item->get('reference'); 
        return $item;
    }

    
}