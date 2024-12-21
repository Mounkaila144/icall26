<?php

class CustomerMeetingViewPartialFormsForContractForm extends mfForm {
    
    protected $forms=null,$parameters=array(),$user=null,$forms_to_display=null,$contract=null;
    
    function __construct($user,$forms_to_display,$contract,$requirements,$defaults=array()) 
    {      
        $this->user=$user;        
        $this->requirements=$requirements;
        $this->forms_to_display=$forms_to_display;
        $this->contract=$contract;
        parent::__construct($defaults, array());
    }
    
    function getContract()
    {
        return $this->contract;
    }
    
    function getUser()
    {
        return $this->user;
    }        
    
    function configure()
    {       
        $this->forms=new CustomerMeetingForms($this->getContract());  
        if (!$this->hasDefaults())
        {         
            //$this->setDefaults($this->forms->setDefaultValues($this->forms->getData()));      
            $this->setDefaults($this->forms->setDefaultValues($this->forms->getCensoredData()));   
        }              
        $forms=CustomerMeetingFormUtilsBase::getPartialVisibleForms($this->forms_to_display);          
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
                  /*  if ($this->requirements)
                    {    
                        foreach ($this->getValidator($form->get('name'))->getSchema() as $name=>$validator)
                        {                            
                            if (isset($this->requirements[$name]))
                                $validator->setOption('required',true);
                        }
                    }*/
           }    
        }   
      //  $this->setValidator('id', new mfValidatorInteger());
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
