<?php

class CustomerMeetingViewFormsForContractForm extends mfForm {
    
    protected $contract=null,$forms=null,$parameters=array(),$user=null;
    public $default_values=null;
    
    function __construct($user,$contract,$defaults=array()) {
        $this->contract=$contract;
        $this->user=$user;        
        parent::__construct($defaults, array());
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function getContract()
    {
        return $this->contract;
    }
    
    function configure()
    {       
        $this->forms=new CustomerMeetingForms($this->getContract());        
        if (!$this->hasDefaults())
        {                 
           // $this->setDefaults($this->forms->setDefaultValues($this->forms->getData()));                         
             $this->setDefaults($this->forms->setDefaultValues($this->forms->getCensoredData()));         
        }    
        $this->schema_forms=CustomerMeetingFormUtils::getVisibleForms();    
        if ($this->getContract()->isHold())
        {                                                
            foreach ($this->schema_forms as $form)
            {     
               if ($form->hasFormfields())
               {    
                        $form->setUser($this->getUser());
                        $schema=$form->getValidatorsForHold($this->getUser());
                        if ($schema->getFields())
                        {    
                            $this->setValidator($form->get('name'),$schema);          
                            $this->parameters[$form->get('name')]=$form->getOptions();
                        }
               }  
            }   
            $this->setValidator('id', new mfValidatorInteger());
        }
        else
        {                          
            foreach ($this->schema_forms as $form)
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
        }       
        $this->default_values=$this->forms->setDefaultValues($this->forms->getData());        
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
    
    
    function getSchemaForms()
    {
        return $this->schema_forms;
    }
      
    function reorganize($validator,$values)
    {
        if ($this->hasErrors())
            return $values;
        return $this->forms->setCensoredData($values);        
    } 
}
