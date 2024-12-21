<?php


 class DomoprimeAssetBaseForm extends mfForm {
 
  
    function configure()
    {
        $this->setValidators(array(
            "id"=>new mfValidatorInteger(),  
           // 'total_asset_without_tax'=>new mfValidatorI18nNumber(),
            'total_asset_with_tax'=>new mfValidatorI18nCurrency(array('currency'=>'EUR')),  
            'total_asset_without_tax'=>new mfValidatorI18nCurrency(array('currency'=>'EUR','required'=>false)),  
            'total_tax'=>new mfValidatorI18nCurrency(array('currency'=>'EUR','required'=>false)),  
            'dated_at'=>new mfValidatorI18nDate(array("date_format"=>"a")),
            'comments'=>new mfValidatorString(array('required'=>false))
            ) 
        );
    }
    
 
}


