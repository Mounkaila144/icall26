<?php



 class DomoprimePolluterModelBillingForm extends mfForm {
    
    
   
    function configure()
    {
         $this->setValidators(array(
            'model_id' =>new mfValidatorChoice(array('required'=>false,'key'=>true,'choices'=>array(""=>__("")) + DomoprimeBillingModel::getModelsI18nForSelect())),                      
         ));
    }
     
  
  
  
  
}


