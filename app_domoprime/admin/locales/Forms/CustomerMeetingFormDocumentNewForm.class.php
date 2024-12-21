<?php




class CustomerMeetingFormDocumentNewForm extends CustomerMeetingFormDocumentBaseForm {
      
          
    function configure()
    {
       parent::configure();
       $this->setValidator('class_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("---"))+DomoprimeClass::getClassForI18nSelect())));
       unset($this['id']);
    }

     function getClass()
    {
        return new DomoprimeClass($this['class_id']->getValue());
    }
   
}
