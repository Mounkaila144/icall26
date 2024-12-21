<?php



class CustomerContractNewBaseForm extends CustomerContractBaseForm {
    
    
         
    function configure()
    {     
       parent::configure();        
       $this->addValidators(array(              
                'state_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+CustomerContractStatusUtils::getStatusForI18nSelect())),
                'financial_partner_id'=> new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+PartnerUtils::getPartnerForSelect())),   
                'tax_id'=> new mfValidatorChoice(array('key'=>true,'choices'=>TaxUtils::getTaxesForSelect())),                             
       ));                   
    }

   

}
