<?php


class CustomerContractSmsPreviewForm extends mfForm {
    
    
    function configure()
    {
        $this->setValidators(array(
            'contract_id'=>new ObjectExistsValidator('CustomerContract',array('key'=>false)),
            'model_i18n_id'=>new ObjectExistsValidator('CustomerModelSmsI18n',array('key'=>false))
        ));
    }
    
    function getContract()
    {
        return $this['contract_id']->getValue();
    }
    
    function getModelI18n()
    {
        return $this['model_i18n_id']->getValue();
    }
}