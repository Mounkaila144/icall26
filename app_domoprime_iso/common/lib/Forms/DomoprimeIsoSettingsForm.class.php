<?php



 class DomoprimeIsoSettingsForm extends mfFormSite {
 
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
            "classic_class"=>new mfValidatorChoice(array("key"=>true,'required'=>false,"choices"=>DomoprimeClass::getClassForI18nSelect($this->getSite()))),                                                                   
            "sales_limit"=>new mfValidatorI18nNumber(),       
            "tax_fee_file"=>new mfValidatorI18nCurrency(array()), 
            "fee_file"=>new mfValidatorI18nCurrency(array()), 
            "quotation_model_id"=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+DomoprimeQuotationModel::getModelsI18nForSelect())),
            "billing_model_id"=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+DomoprimeBillingModel::getModelsI18nForSelect())),
            "asset_model_id"=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+DomoprimeAssetModel::getModelsI18nForSelect())),
            "install_in_progess_status_id"=>new mfValidatorChoice(array("key"=>true,"required"=>false,"choices"=>array(""=>"")+CustomerContractStatusUtils::getStatusForI18nSelect($this->getSite()))),                        
            "energy_filter"=>new mfValidatorChoice(array("key"=>true,'multiple'=>true,"required"=>false,"choices"=>array(""=>"")+DomoprimeEnergy::getEnergyForI18nSelect($this->getSite()))),            
            "class_filter"=>new mfValidatorChoice(array("key"=>true,'multiple'=>true,"required"=>false,"choices"=>array(""=>"")+DomoprimeClass::getClassForI18nSelect($this->getSite()))),                        
            "quotation_reference_format"=>new mfValidatorString(array('trim'=>true,'required'=>false)),
            "simulation_reference_format"=>new mfValidatorString(array('trim'=>true,'required'=>false)),
            "billing_reference_format"=>new mfValidatorString(array('trim'=>true,'required'=>false)),          
            "asset_reference_format"=>new mfValidatorString(array('trim'=>true,'required'=>false)),                  
            "quotation_shift_for_dated_at"=>new mfValidatorInteger(array('min'=>0)), 
            "tax_credit"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")), 
            "ah_archivage"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),            
            "quotation_archivage"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
            "billing_archivage"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
            "premeeting_archivage"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
            "verif_archivage"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
            "signed_verif_archivage"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
            "multi_documents_archivage"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),           
            "billing_email_model_id"=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerModelEmailUtils::getModelEmailsForSelect())),
            'model_101_R1_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerMeetingFormDocument::getDocumentsForSelect()->toArray())),
            'model_102_R1_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerMeetingFormDocument::getDocumentsForSelect()->toArray())),
            'model_103_R1_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerMeetingFormDocument::getDocumentsForSelect()->toArray())),
            'model_101_R2_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerMeetingFormDocument::getDocumentsForSelect()->toArray())),
            'model_102_R2_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerMeetingFormDocument::getDocumentsForSelect()->toArray())),
            'model_103_R2_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerMeetingFormDocument::getDocumentsForSelect()->toArray())),
            'model_101_102_R1_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerMeetingFormDocument::getDocumentsForSelect()->toArray())),
            'model_101_102_R2_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerMeetingFormDocument::getDocumentsForSelect()->toArray())),
            'model_101_103_R1_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerMeetingFormDocument::getDocumentsForSelect()->toArray())),
            'model_101_103_R2_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerMeetingFormDocument::getDocumentsForSelect()->toArray())),
            'model_102_103_R1_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerMeetingFormDocument::getDocumentsForSelect()->toArray())),
            'model_102_103_R2_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerMeetingFormDocument::getDocumentsForSelect()->toArray())),
            'model_101_102_103_R1_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerMeetingFormDocument::getDocumentsForSelect()->toArray())),
            'model_101_102_103_R2_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerMeetingFormDocument::getDocumentsForSelect()->toArray())),            
            
            'model_101_R1_classic_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerMeetingFormDocument::getDocumentsForSelect()->toArray())),
            'model_102_R1_classic_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerMeetingFormDocument::getDocumentsForSelect()->toArray())),
            'model_103_R1_classic_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerMeetingFormDocument::getDocumentsForSelect()->toArray())),
            'model_101_R2_classic_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerMeetingFormDocument::getDocumentsForSelect()->toArray())),
            'model_102_R2_classic_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerMeetingFormDocument::getDocumentsForSelect()->toArray())),
            'model_103_R2_classic_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerMeetingFormDocument::getDocumentsForSelect()->toArray())),
            'model_101_102_R1_classic_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerMeetingFormDocument::getDocumentsForSelect()->toArray())),
            'model_101_102_R2_classic_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerMeetingFormDocument::getDocumentsForSelect()->toArray())),
            'model_101_103_R1_classic_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerMeetingFormDocument::getDocumentsForSelect()->toArray())),
            'model_101_103_R2_classic_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerMeetingFormDocument::getDocumentsForSelect()->toArray())),
            'model_102_103_R1_classic_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerMeetingFormDocument::getDocumentsForSelect()->toArray())),
            'model_102_103_R2_classic_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerMeetingFormDocument::getDocumentsForSelect()->toArray())),
            'model_101_102_103_R1_classic_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerMeetingFormDocument::getDocumentsForSelect()->toArray())),
            'model_101_102_103_R2_classic_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+CustomerMeetingFormDocument::getDocumentsForSelect()->toArray())),            
            'transfer_number_of_items'=>new mfValidatorI18nNumber(array('max'=>5000)),
            "premeeting_model_id"=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+DomoprimePreMeetingModel::getModelsI18nForSelect())),
            'default_occupation_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"")+ DomoprimeOccupation::getOccupationForI18nSelect())),          
        ));   
        if ($settings->get('mode')!='DATABASE')
        {    
            $this->setValidator("mode",new mfValidatorChoice(array("key"=>true,"choices"=>array("FORM"=>__("Forms"),"DATABASE"=>__("Database")))));
        }
        if ($this->getUser()->hasCredential(array(array('superadmin'))))
        {
             $this->setValidator("quotation_engine",new mfValidatorString());
             $this->setValidator("simulation_engine",new mfValidatorString());
             $this->setValidator("coef_multiples",new mfValidatorBoolean(array("empty_value"=>false)));
        }    
                
    }
    
   
 
}


