<?php

class CustomerMeetingNewForms extends mfFormSite {
    
    protected $parameters=array();
    
    
    function __construct($defaults = array(), $site = null) {
        parent::__construct($defaults, array(), $site);
    }
    
    function configure()
    {
        $forms=CustomerMeetingFormUtilsBase::getForms($this->getSite());        
        foreach ($forms as $form)
        {                      
            $this->setValidator($form->get('name'),$form->getValidators());          
            $this->parameters[$form->get('name')]=$form->getOptions();
        }    
     //  var_dump($this->form1); //['f1']);
    }
    
    function getParameters()
    {
       return $this->parameters;  
    }
}
