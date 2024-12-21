<?php



class CustomerContractViewForm extends CustomerContractBaseForm {
      
         
    function configure()
    {
        parent::configure();        
        $this->addValidators(array(
                'state_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+CustomerContractStatusUtils::getStatusForI18nSelect($this->getSite()))),
                'financial_partner_id'=> new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+PartnerUtils::getPartnerForSelect($this->getSite()))),   
                'tax_id'=> new mfValidatorChoice(array('key'=>true,'choices'=>TaxUtils::getTaxesForSelect($this->getSite()))),              
            ));
    }

   

}
