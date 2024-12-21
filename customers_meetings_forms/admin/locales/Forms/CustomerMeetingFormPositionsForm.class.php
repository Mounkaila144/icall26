<?php


 class CustomerMeetingFormsForm extends mfForm {
     
     function configure()
     {
         $this->setValidators(array(
             'id'=>new mfValidatorInteger(array('min'=>1)),
             'formfields'=>new mfValidatorSchemaForEach(new mfValidatorInteger(),count($this->getDefault('formfields'))),  
         ));
     }
 }


 class CustomerMeetingFormPositionsForm extends mfForm {
    
    
   
    function configure()
    {      
      $this->createEmbedFormForEach('forms','CustomerMeetingFormsForm',count($this->getDefault('forms')));       
      $this->validatorSchema->setPostValidator(new mfValidatorCallback(array('callback' => array($this, 'check')))); 
    }
    
   function check($validator,$values)
   {
       // echo "<pre>"; var_dump($values); echo "</pre>"; 
        if ($this->getErrorSchema()->hasErrors())
            return $values;
        $forms=array();
        foreach ($values['forms'] as $form)
           $forms[]=$form['id'];
      //  var_dump($forms);
       if (!CustomerMeetingFormUtils::checkForms($forms))
           throw new mfValidatorErrorSchema($validator,array("forms"=>new mfValidatorError($validator,__("form is invalid."))));  
       $formFields=array();
       foreach ($values['forms'] as $form)
       {
           foreach ($form['formfields'] as $field)
                $formFields[]=$field;    
       }    
     //  var_dump($formFields);
        if (!CustomerMeetingFormUtils::checkFormFields($formFields))
           throw new mfValidatorErrorSchema($validator,array("forms"=>new mfValidatorError($validator,__("formfield is invalid."))));  
        return $values;
   }
}


