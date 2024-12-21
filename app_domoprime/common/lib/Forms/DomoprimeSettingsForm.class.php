<?php



 class DomoprimeSettingsForm extends mfFormSite {
 
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
        $settings=DomoprimeSettings::load($this->getSite());       
        $this->setValidators(array(
            "sales_limit"=>new mfValidatorI18nNumber(),            
            "quotation_model_id"=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+DomoprimeQuotationModel::getModelsI18nForSelect())),
            "billing_model_id"=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+DomoprimeBillingModel::getModelsI18nForSelect())),
            "asset_model_id"=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+DomoprimeAssetModel::getModelsI18nForSelect())),
            "premeeting_model_id"=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+DomoprimePreMeetingModel::getModelsI18nForSelect())),
            "install_in_progess_status_id"=>new mfValidatorChoice(array("key"=>true,"required"=>false,"choices"=>array(""=>"")+CustomerContractStatusUtils::getStatusForI18nSelect($this->getSite()))),                        
            "energy_filter"=>new mfValidatorChoice(array("key"=>true,'multiple'=>true,"required"=>false,"choices"=>array(""=>"")+DomoprimeEnergy::getEnergyForI18nSelect($this->getSite()))),            
            "class_filter"=>new mfValidatorChoice(array("key"=>true,'multiple'=>true,"required"=>false,"choices"=>array(""=>"")+DomoprimeClass::getClassForI18nSelect($this->getSite()))),                        
            "quotation_reference_format"=>new mfValidatorString(array('trim'=>true,'required'=>false)),
            "billing_reference_format"=>new mfValidatorString(array('trim'=>true,'required'=>false)),          
            "asset_reference_format"=>new mfValidatorString(array('trim'=>true,'required'=>false)),                  
            "quotation_shift_for_dated_at"=>new mfValidatorInteger(array('min'=>0)), 
            "fee_file"=>new mfValidatorI18nNumber(array('min'=>0)), 
            "pourcentage_advance"=>new mfValidatorI18nPourcentage(array('min'=>0,'required'=>false)), 
            "ah_archivage"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),            
            "quotation_archivage"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
            "billing_archivage"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
            "multi_documents_archivage"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
            "billing_email_model_id"=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerModelEmailUtils::getModelEmailsForSelect())),
            "after_work_model_id"=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+DomoprimeAfterWorkModel::getModelsI18nForSelect())),
        //    "ana_tax"=>new mfValidatorI18nCurrency(array('required'=>false)), 
         //   "ana_pack_tax"=>new mfValidatorI18nCurrency(array('required'=>false)), 
        ));
        if ($this->getUser()->hasCredential(array(array('superadmin')))) 
        {
           $products=ProductUtils::getProductsForSelect($this->getSite());
           $this->addValidators(array(            
            "surface_wall_formfield"=> new mfValidatorChoice(array("key"=>true,"choices"=>CustomerMeetingFormUtils::getFormFieldsI18nForSelect($this->getSite())->toArray())),                                   
            "surface_top_formfield"=> new mfValidatorChoice(array("key"=>true,"choices"=>CustomerMeetingFormUtils::getFormFieldsI18nForSelect($this->getSite())->toArray())),                                   
            "surface_floor_formfield"=> new mfValidatorChoice(array("key"=>true,"choices"=>CustomerMeetingFormUtils::getFormFieldsI18nForSelect($this->getSite())->toArray())),                                   
            "energy_formfield"=> new mfValidatorChoice(array("key"=>true,"choices"=>CustomerMeetingFormUtils::getFormFieldsI18nForSelect($this->getSite())->toArray())),                                   
            "number_of_people_formfield"=> new mfValidatorChoice(array("key"=>true,"choices"=>CustomerMeetingFormUtils::getFormFieldsI18nForSelect($this->getSite())->toArray())),                                   
            "revenue_formfield"=> new mfValidatorChoice(array("key"=>true,"choices"=>CustomerMeetingFormUtils::getFormFieldsI18nForSelect($this->getSite())->toArray())),                                   
            "owner_formfield"=> new mfValidatorChoice(array("key"=>true,"choices"=>CustomerMeetingFormUtils::getFormFieldsI18nForSelect($this->getSite())->toArray())),                                                
            "owner_1_formfield_value"=>new mfValidatorChoice(array("key"=>true,'required'=>false,"choices"=>CustomerMeetingFormUtils::getFormFieldValuesI18nFromFormFieldForSelect($settings->get('owner_formfield'),$this->getSite()))),                                            
            "owner_2_formfield_value"=>new mfValidatorChoice(array("key"=>true,'required'=>false,"choices"=>CustomerMeetingFormUtils::getFormFieldValuesI18nFromFormFieldForSelect($settings->get('owner_formfield'),$this->getSite()))),                                               
            "owner_3_formfield_value"=>new mfValidatorChoice(array("key"=>true,'required'=>false,"choices"=>CustomerMeetingFormUtils::getFormFieldValuesI18nFromFormFieldForSelect($settings->get('owner_formfield'),$this->getSite()))),                                                                    
            "surface_wall_product"=>new mfValidatorChoice(array("key"=>true,'required'=>false,"choices"=> $products)),                                            
            "surface_floor_product"=>new mfValidatorChoice(array("key"=>true,'required'=>false,"choices"=> $products)),   
            "classic_class"=>new mfValidatorChoice(array("key"=>true,'required'=>false,"choices"=>DomoprimeClass::getClassForI18nSelect($this->getSite()))),                                                                                     
            "surface_top_product"=>new mfValidatorChoice(array("key"=>true,'required'=>false,"choices"=> $products)),                                                       
            "multiple_billings_max"=>new mfValidatorInteger(array('min'=>1)),
            "coef_multiples"=>new mfValidatorBoolean(array("empty_value"=>false)),
            ));  
            $this->energy_fields=DomoprimeEnergy::getEnergyI18nForSelect($this->getSite());
            foreach ($this->energy_fields as $energy_i18n)
            {
                $this->setValidator('energy_'.$energy_i18n->get('energy_id'),new mfValidatorChoice(array("key"=>true,'required'=>false,"choices"=>CustomerMeetingFormUtils::getFormFieldValuesI18nFromFormFieldForSelect($settings->get('energy_formfield'),$this->getSite()))));
            } 
        }                                 
    }
    
    function getEnergyI18nFields()
    {
        return $this->energy_fields;
    } 
    
    function getEnergyFields()
    {
       // return array( "energy_combustible"=>"energy_combustible_formfield_value","energy_electricity"=>"energy_electricity_formfield_value");
    }
    
  /*  function getEnergyFields()
    {
        return array( "energy_combustible"=>"energy_combustible_formfield_value","energy_electricity"=>"energy_electricity_formfield_value");
    }*/
    
      function getOwnerFields()
    {
        return array( "owner_1_formfield_value","owner_2_formfield_value","owner_3_formfield_value");
    }
 
}


