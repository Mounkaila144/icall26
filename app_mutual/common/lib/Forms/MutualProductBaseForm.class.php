<?php

class MutualProductBaseForm extends mfForm {
   
    function configure()
    {
        $this->setValidators(array(
            "id"=>new mfValidatorInteger(),                                    
            "name"=>new mfValidatorString(array("min_length"=>1,"max_length"=>64)),                                                         
            "price"=>new mfValidatorI18nCurrency(),                                                         
        ));
    }

}


