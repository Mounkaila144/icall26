<?php

class ExportMultipleExtendedModelForPolluterForm extends mfForm {
            
    function configure()
    {
        $this->setValidators(array(
            'selection'=>new mfValidatorMultiple(new mfValidatorInteger(),array('required'=>false,'empty_value'=>new mfArray())),
            'polluter'=>new ObjectExistsValidator('DomoprimePollutingCompany',array('key'=>false))
        ));
                
    }
    
    function getPolluter()
    {
        return $this['polluter']->getValue();
    }
        
    
    function getSelection()
    {       
        return DomoprimePartnerPolluterModelUtils::getModelsByDocumentForPolluterFromSelection($this->getPolluter(),$this['selection']->getValue());      
    }
    
}
