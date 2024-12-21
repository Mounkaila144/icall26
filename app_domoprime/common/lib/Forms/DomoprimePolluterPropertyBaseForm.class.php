<?php

class DomoprimePolluterPropertyBaseForm extends mfForm {
    
    function configure()
    {
         $this->setValidators(array(
             'prime'=>new mfValidatorI18nCurrency(array('required'=>false)),
             'pack_prime'=>new mfValidatorI18nCurrency(array('required'=>false)),
         ));
    }
}

