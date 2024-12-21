<?php



 class DomoprimePolluterModelQuotationForm extends mfForm {
    
    
   
    function configure()
    {        
         $this->setValidators(array(
            'model_id' =>new mfValidatorChoice(array('key'=>true,'choices'=>array(""=>__("")) + DomoprimeQuotationModel::getModelsI18nForSelect())),                      
            'pre_model_id' =>new mfValidatorChoice(array('required'=>false,'key'=>true,'choices'=>PartnerPolluterModelUtils::getModelsForSelect()->unshift(array(""=>__("Not defined"))))),                      
            'post_company_model_id' =>new mfValidatorChoice(array('required'=>false,'key'=>true,'choices'=>SiteCOmpanyModelUtils::getModelsForSelect()->unshift(array(""=>__("Not defined"))))),                      
         ));
    }
     
  
  
  
  
}


