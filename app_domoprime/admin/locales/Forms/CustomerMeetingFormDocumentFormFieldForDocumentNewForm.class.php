<?php




class CustomerMeetingFormDocumentFormfieldForDocumentNewForm extends CustomerMeetingFormDocumentFormfieldBaseForm {
      
          
    function configure()
    {             
       $this->formfields=CustomerMeetingFormUtils::getFormFieldsI18nForSelect();       
       parent::configure();              
       $this->addValidators(array(
           'formfield_id'=>new mfValidatorChoice(array('key'=>true,'choices'=>$this->formfields->toArray())),      
       ));   
       unset($this['id']);
    }
  
  
}

