<?php



 class PartnerPolluterDocumentForPolluterForm extends mfForm {
    
     protected $polluter=null;
     
    function __construct($polluter,$defaults = array(), $options = array()) {
        $this->polluter=$polluter;
        parent::__construct($defaults, $options);
    }
   
    function configure()
    {
         $this->setValidators(array(
            'model_id' =>new mfValidatorChoice(array('required'=>false,'key'=>true,'choices'=>array(""=>__("")) + PartnerPolluterModelUtils::getModelsForPolluterForSelect($this->polluter)->toArray())),           
            'document_id'=>new ObjectExistsValidator('CustomerMeetingFormDocument',array('key'=>false)),
         ));
    }
     
  
  function getDocument()
  {
       if ($this->hasErrors())
          return new CustomerMeetingFormDocument($this->getDefault('document_id'));
      return $this['document_id']->getValue();
  }
  
  
  
}


