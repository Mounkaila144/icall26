<?php

class CustomerMeetingNewForms extends mfForm {
    
   protected $parameters=array();        
    
    function configure()
    {
        $forms=CustomerMeetingFormUtilsBase::getVisibleForms();        
        foreach ($forms as $form)
        {                          
            $this->setValidator($form->get('name'),$form->getValidators());   
             $this->parameters[$form->get('name')]=$form->getOptions();
             
         //  var_dump($form->get('name'),$form->getValidators()->getFields());
        }    
     //  var_dump($this->form1); //['f1']);
    }
    
     function getParameters()
    {
       return $this->parameters;  
    }
}
