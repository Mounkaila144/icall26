<?php

class MutualPartnerParamsBaseForm extends mfForm {
   
    function configure()
    {
        $this->setValidators(array(
            "id"=>new mfValidatorInteger(),                                    
            "financial_partner_id"=>new mfValidatorInteger(),                                    
            "taxe"=>new mfValidatorI18nPourcentage(),                                                         
            "fees"=>new mfValidatorI18nCurrency(),                                                      
            "started_at"=>new mfValidatorI18nDate(array("date_format"=>"a","required"=>false)),                                                         
            "ended_at"=>new mfValidatorI18nDate(array("date_format"=>"a","required"=>false)),                                                             
        ));
    }

}


