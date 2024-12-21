<?php



 class CustomerMeetingFormsFilterSettingsForm extends mfFormSite {
 
    protected $forms=null,$settings=null;
             
    function __construct($settings,$defaults,$site=null) {       
        $this->settings=$settings;
        parent::__construct($defaults,array(),$site);        
    }
  
    function configure()
    {        
        $choices=CustomerMeetingFormUtilsBase::getFormFieldsForChoice($this->getSite());
        $this->setValidators(array(            
                'filter_columns'=>new mfValidatorChoice(array("required"=>false,"multiple"=>true,"choices"=>$choices)),
                'display_columns'=>new mfValidatorChoice(array("required"=>false,"multiple"=>true,"choices"=>$choices)),
            ) 
        );                      
    }
    
    function hasForms()
    {
       $this->getForms();
       return (boolean)$this->forms;
    }
    
    function getForms()
    {
        if ($this->form===null)
            $this->forms=CustomerMeetingFormUtilsBase::getChoiceForms($this->getSite());
        return $this->forms;
    }
    
    function hasFormField($field)
    {        
        return array_key_exists($field,$this->settings->get('filter_columns'));
    }
    
    function hasDisplayFormfield($field)
    {        
        return array_key_exists($field,$this->settings->get('display_columns'));
    }
    
    function getColumns()
    {                            
        return array('filter_columns'=>CustomerMeetingFormUtils::getFormFieldsNameFromFormFields($this->getValue('filter_columns'),$this->getSite()),
                     'display_columns'=>CustomerMeetingFormUtils::getFormFieldsNameFromFormFields($this->getValue('display_columns'),$this->getSite())
                    );
    }
    
   
}


