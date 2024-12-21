<?php


class CustomerMeetingFormsModelEmailVariables extends UtilsModelVariables {
    
    protected $site=null;
    
    function __construct($site=null) {
        $this->site=$site;
        parent::__construct();
    }
    
    function getSite()
    {
        return $this->site;
    }
    
    function configure($dictionnary='dictionary')
    {        
        $forms=CustomerMeetingFormUtils::getForms($this->getSite());
        foreach ($forms as $form)
        {           
           foreach ($form->getFormfields() as $field)
           {             
               if ($field->get('type')=='choice')
               {    
                    $this->variables['meeting.forms.'.$form->get('name').".".$field->get('name').".value"]=$form->getI18n()->get('value').":".$field->getI18n()->get('request')." ".__("(value)");      
                    $this->variables['meeting.forms.'.$form->get('name').".".$field->get('name').".text"]=$form->getI18n()->get('value').":".$field->getI18n()->get('request')." ".__("(text)");      
               }     
               else
                    $this->variables['meeting.forms.'.$form->get('name').".".$field->get('name')]=$form->getI18n()->get('value').":".$field->getI18n()->get('request');  
           }              
        }        
    } 
    
  
    
    
}


