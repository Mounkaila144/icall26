<?php




class CustomerMeetingFormDocumentFormfieldForDocumentViewForm extends CustomerMeetingFormDocumentFormfieldBaseForm {
      
          
    function configure()
    {      
       $this->formfields=CustomerMeetingFormUtils::getFormFieldsI18nForSelect();
       parent::configure();
       $this->addValidators(array(
           'formfield_id'=>new mfValidatorChoice(array('key'=>true,'choices'=>$this->formfields->toArray())),
       //    'class_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("---"))+DomoprimeClass::getClassForI18nSelect()))
       ));         
    }

   /* function getClass()
    {
        return new DomoprimeClass($this['class_id']->getValue());
    }*/
}
