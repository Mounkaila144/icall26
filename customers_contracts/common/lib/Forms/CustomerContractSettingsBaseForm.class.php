<?php



 class CustomerContractSettingsBaseForm extends mfFormSite {
 
     protected $user=null;
    function __construct($user,$site=null) {       
        $this->user=$user;
        parent::__construct(array(),array(),$site);
    }
    
    function getUser()
    {
        return $this->user;
    }
  
    function configure()
    {
        $this->setValidators(array(            
            "default_status_id"=> new mfValidatorChoice(array("key"=>true,'required'=>false,"choices"=>array(""=>"")+CustomerContractStatusUtils::getStatusForI18nSelect($this->getSite()))),            
            "default_attribution_id"=> new mfValidatorChoice(array("key"=>true,'required'=>false,"choices"=>array(""=>"")+UserAttributionUtils::getAttributionsForI18nSelect($this->getSite()))),            
            "tax_amount_display"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
            "tax_amount_display_list"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
            "autocomplete_list"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
            "ttc_change_by_tax"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
            "comment_sale1"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
            "comment_sale2"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
            "comment_delete"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
            "comment_creation"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
            "format_id"=>new mfValidatorString(array('required'=>false)),
            "number_of_day_for_opc"=>new mfValidatorInteger(array('min'=>0,'max'=>10,'required'=>false)),
            "change_state_email_model_id"=>new mfValidatorChoice(array("key"=>true,"required"=>false,"choices"=>array(""=>"")+UserModelEmailBaseUtils::getModelI18nEmailForSelect($this->getSite()))),    
            "hold_statuses"=>new mfValidatorChoice(array("key"=>true,'required'=>false,'multiple'=>true,"choices"=>array(""=>"")+CustomerContractStatusUtils::getStatusForI18nSelect($this->getSite()))),            
            "status_if_confirmed_id"=> new mfValidatorChoice(array("key"=>true,'required'=>false,"choices"=>array(""=>"")+CustomerContractStatusUtils::getStatusForI18nSelect($this->getSite()))),            
            "status_if_unconfirmed_id"=> new mfValidatorChoice(array("key"=>true,'required'=>false,"choices"=>array(""=>"")+CustomerContractStatusUtils::getStatusForI18nSelect($this->getSite()))),            
            "status_for_cancel_id"=> new mfValidatorChoice(array("key"=>true,'required'=>false,"choices"=>array(""=>"")+CustomerContractStatusUtils::getStatusForI18nSelect($this->getSite()))),            
            "status_for_uncancel_id"=> new mfValidatorChoice(array("key"=>true,'required'=>false,"choices"=>array(""=>"")+CustomerContractStatusUtils::getStatusForI18nSelect($this->getSite()))),            
            
            "status_for_blowing_id"=> new mfValidatorChoice(array("key"=>true,'required'=>false,"choices"=>array(""=>"")+CustomerContractStatusUtils::getStatusForI18nSelect($this->getSite()))),            
            "status_for_unblowing_id"=> new mfValidatorChoice(array("key"=>true,'required'=>false,"choices"=>array(""=>"")+CustomerContractStatusUtils::getStatusForI18nSelect($this->getSite()))),            
            
            "status_for_placement_id"=> new mfValidatorChoice(array("key"=>true,'required'=>false,"choices"=>array(""=>"")+CustomerContractStatusUtils::getStatusForI18nSelect($this->getSite()))),            
            "status_for_unplacement_id"=> new mfValidatorChoice(array("key"=>true,'required'=>false,"choices"=>array(""=>"")+CustomerContractStatusUtils::getStatusForI18nSelect($this->getSite()))),            
            
             "comment_opc_status"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
             "comment_install_status"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
             "comment_time_state"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
             "has_partner_layer"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
             "change_state_sales_model_email_id"=>new mfValidatorChoice(array("key"=>true,"required"=>false,"choices"=>array(""=>"")+UserModelEmailBaseUtils::getModelI18nEmailForSelect($this->getSite()))),                       
             "default_status1_for_no_billable_contract"=> new mfValidatorChoice(array("key"=>true,'required'=>false,"choices"=>array(""=>"")+CustomerContractStatusUtils::getStatusForI18nSelect($this->getSite()))),
             "default_status2_for_no_billable_contract"=> new mfValidatorChoice(array("key"=>true,'required'=>false,"choices"=>array(""=>"")+CustomerContractStatusUtils::getStatusForI18nSelect($this->getSite()))),          
            ) 
        );    
        if ($this->getUser()->hasCredential(array(array('superadmin'))))
           $this->setValidator('number_of_attributions', new mfValidatorI18nNumber(array('min'=>10,'max'=>5000,'required'=>false,'empty_value'=>500))) ;
        if ($this->getUser()->hasCredential(array(array('superadmin','settings_contract_settings_default_company'))))
           $this->setValidator("default_company_id",new mfValidatorChoice(array("key"=>true,'required'=>false,"choices"=>CustomerContractCompany::getCompaniesForSelect($this->getSite())->unshift(array(""=>"")))));
    }
    
 
}


