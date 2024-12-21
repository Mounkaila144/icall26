<?php
 
class CustomerMeetingFormImportModel extends XmlImport {
    
  
    
    function getName()
    {
        return $this->form->name;
    }
    
    function getTitle()
    {
        return $this->form->name['value'];
    }
  
    
    function getFields()
    {
        return $this->form->fields;
    }
}

