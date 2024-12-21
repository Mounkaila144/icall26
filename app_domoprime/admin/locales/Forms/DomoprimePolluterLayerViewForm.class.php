<?php

class DomoprimePolluterLayerViewForm extends mfForm {
    
    function configure()
    {
        $this->setValidators(array(
            'id'=>new mfValidatorInteger(),
            'layer_id'=>new mfValidatorChoice(array('required'=>false,'key'=>true,'choices'=>array(''=>'')+PartnerLayerCompany::getLayersForSelect())),     
           
        ));
    }
        
}
