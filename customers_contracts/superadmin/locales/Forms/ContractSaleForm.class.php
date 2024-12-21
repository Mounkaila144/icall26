<?php


class ContractSaleForm extends mfForm {
    
    function configure()
    {
      $this->setValidators(array(
            'sale'=>new mfValidatorChoice(array('choices'=>array('Sale1','Sale2'))),                          
                ));
    }
}

