<?php


class CustomerContractRecipientForPolluterViewForm extends mfForm{
    
    
    
    function configure() {
         $this->setValidators(array(
           'recipient_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=> array(""=>__("---"))+PartnerRecipientCompany::getRecipientsForSelect()))          
                 ));
    }
}

