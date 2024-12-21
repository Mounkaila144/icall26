<?php

class MutualProductCommissionBaseForm extends mfForm {
   
    function configure()
    {
        $this->setValidators(array(
            "id"=>new mfValidatorInteger(),                                    
            "from"=>new mfValidatorInteger(),                                                         
            "to"=>new mfValidatorInteger(),                                                         
            "rate"=>new mfValidatorI18nPourcentage(),                                                      
            "started_at"=>new mfValidatorI18nDate(array("date_format"=>"a")),                                                         
            "ended_at"=>new mfValidatorI18nDate(array("date_format"=>"a")),                                                         
        ));
    }

}