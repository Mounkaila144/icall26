<?php

class CustomerMeetingViewForms extends mfFormSite {
    
    protected $meeting=null,$forms=null,$parameters=array();
    
    function __construct($meeting,$defaults=array()) {
        $this->meeting=$meeting;
        parent::__construct($defaults, array(), $meeting->getSite());
    }
    
    function getMeeting()
    {
        return $this->meeting;
    }
    
    function configure()
    {       
        $this->forms=new CustomerMeetingForms($this->getMeeting(),$this->getSite());
        if (!$this->hasDefaults())
        {
            $this->setDefaults($this->forms->getData());               
        }
        $forms=CustomerMeetingFormUtilsBase::getForms($this->getSite());        
        foreach ($forms as $form)
        {     
           if ($form->hasFormfields())
           {    
               $this->setValidator($form->get('name'),$form->getValidators());          
               $this->parameters[$form->get('name')]=$form->getOptions();
           }    
        }   
        $this->setValidator('id', new mfValidatorInteger());
    }
    
     function getParameters()
    {
       return $this->parameters;  
    }
    
    function getForms()
    {
        $values=$this->getValues();
        unset($values['id']);           
        $this->forms->setData($values,$this->getParameters());         
        return $this->forms;
    }
    
    
}
