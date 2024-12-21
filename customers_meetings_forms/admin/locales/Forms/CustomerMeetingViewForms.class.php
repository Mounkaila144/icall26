<?php

class CustomerMeetingViewForms extends mfForm {
    
    protected $meeting=null,$forms=null,$parameters=array(),$user=null;
    
    function __construct($user,$meeting,$defaults=array()) {
        $this->meeting=$meeting;
        $this->user=$user;        
        parent::__construct($defaults, array());
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function getMeeting()
    {
        return $this->meeting;
    }
    
    function configure()
    {       
        $this->forms=new CustomerMeetingForms($this->getMeeting());  
        if (!$this->hasDefaults())
        {         
           // $this->setDefaults($this->forms->setDefaultValues($this->forms->getData()));                 
            $this->setDefaults($this->forms->setDefaultValues($this->forms->getCensoredData()));         
        }              
        $forms=CustomerMeetingFormUtilsBase::getVisibleForms();        
        foreach ($forms as $form)
        {     
           if ($form->hasFormfields())
           {    
                    $form->setUser($this->getUser());
                    $schema=$form->getValidators($this->getUser());
                    if ($schema->getFields())
                    {    
                        $this->setValidator($form->get('name'),$schema);          
                        $this->parameters[$form->get('name')]=$form->getOptions();
                    }
           }    
        }   
        $this->setValidator('id', new mfValidatorInteger());    
        $this->validatorSchema->setPostValidator(new mfValidatorCallback(array('callback' => array($this, 'reorganize'))));
    }
    
    function getParameters()
    {
       return $this->parameters;  
    }
    
    function getForms()
    {
         if ($this->_forms===null)
        {
        $values=$this->getValues();        
        unset($values['id']);      
          $this->_forms=$this->forms->setData($values,$this->getParameters());      
        }
        return $this->_forms;
    }
    
    function reorganize($validator,$values)
    {
        if ($this->hasErrors())
            return $values;
        return $this->forms->setCensoredData($values);        
    } 
}
