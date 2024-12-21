<?php


 class DomoprimeCustomerRequestNewForm extends DomoprimeCustomerRequestBaseForm {
 
     protected $user=null,$settings=null;
     
     function __construct($user,$defaults = array(), $options = array()) {
         $this->user=$user;
         $this->settings=new DomoprimeIsoSettings();
         parent::__construct($defaults, $options);
     }
     
     function getUser()
     {
         return $this->user;
     }
     
     function getSettings()
     {
         return $this->settings;
     }
  
    function configure()
    {           
         parent::configure();
         if (!$this->getUser()->hasCredential(array(array('contract_new_request_remove_fields','meeting_new_request_remove_fields'))))
         {                 
            $this->addValidators(array(
                'energy_id'=>new mfValidatorChoice(array('key'=>true,'choices'=>DomoprimeEnergy::getEnergyForI18nSelect())),
                'occupation_id'=>new mfValidatorChoice(array('key'=>true,'choices'=>DomoprimeOccupation::getOccupationForI18nSelect())),
                'layer_type_id'=>new mfValidatorChoice(array('key'=>true,'choices'=>DomoprimeTypeLayer::getTypeLayerForI18nSelect())),
            ));    
         }
         else
         {
            unset($this['revenue'],$this['number_of_people'],$this['surface_wall'],$this['surface_top'],$this['declarants'],
            $this['surface_floor'],$this['number_of_fiscal'],$this['tax_credit_used'],$this['more_2_years']);
         }   
         if ($this->getUser()->hasCredential(array(array('contract_new_request_install_surface_wall','meeting_new_request_install_surface_wall'))))
            $this->setValidator('install_surface_wall',new mfValidatorI18nNumber(array('required'=>false)));
         if ($this->getUser()->hasCredential(array(array('contract_new_request_install_surface_top','meeting_new_request_install_surface_top'))))
            $this->setValidator('install_surface_top',new mfValidatorI18nNumber(array('required'=>false)));
         if ($this->getUser()->hasCredential(array(array('contract_new_request_install_surface_floor','meeting_new_request_install_surface_floor'))))
            $this->setValidator('install_surface_floor',new mfValidatorI18nNumber(array('required'=>false)));
         if ($this->getUser()->hasCredential(array(array('contract_new_request_parcel_surface','meeting_new_request_parcel_surface'))))
            $this->setValidator('parcel_surface',new mfValidatorI18nNumber(array('required'=>false)));
         if ($this->getUser()->hasCredential(array(array('contract_new_request_parcel_reference','meeting_new_request_parcel_reference'))))
            $this->setValidator('parcel_reference',new mfValidatorString(array('required'=>false)));
          if ($this->getUser()->hasCredential(array(array('contract_new_request_number_of_parts','meeting_new_request_number_of_parts'))))
            $this->setValidator('number_of_parts',new mfValidatorI18nNumber(array('required'=>false)));
         unset($this['id']);         
        if ($this->getUser()->hasCredential(array(array('app_domoprime_iso2_contract_new_pricing','app_domoprime_iso2_meeting_new_pricing'))))
             $this->setValidator('pricing_id',new mfValidatorChoice(array('required'=>false,'key'=>true,'choices'=>DomoprimeIsoCumacPrice::getPricingForSelect()->unshift(array(''=>'')))));
        if ($this->getUser()->hasCredential(array(array('contract_new_request_surface_ite','meeting_new_request_surface_ite'))))
              $this->setValidator('surface_ite',new mfValidatorI18nNumber(array('required'=>false)));
        if ($this->getUser()->hasCredential(array(array('contract_new_request_packboiler_quantity','meeting_new_request_packboiler_quantity'))))
              $this->setValidator('packboiler_quantity',new mfValidatorI18nNumber(array('required'=>false)));
        if ($this->getUser()->hasCredential(array(array('contract_new_request_boiler_quantity','meeting_new_request_boiler_quantity'))))
              $this->setValidator('boiler_quantity',new mfValidatorI18nNumber(array('required'=>false)));
        if ($this->getUser()->hasCredential(array(array('contract_new_request_pack_quantity','meeting_new_request_pack_quantity'))))
              $this->setValidator('pack_quantity',new mfValidatorI18nNumber(array('required'=>false)));
        if ($this->getUser()->hasCredential(array(array('contract_meeting_request_default_value'))) && !$this->getDefaults())    
        {          
             if ($this->hasValidator('occupation_id'))
             {    
                  $this->setDefault('occupation_id', $this->getSettings()->get('default_occupation_id'));
             }
             foreach (array('surface_ite','pack_quantity','boiler_quantity','number_of_parts') as $field)
             {
                if($this->getUser()->hasCredential(array(array('contract_new_request_'.$field,'meeting_new_request_'.$field))))
                    $this->setDefault($field, $this->getSettings()->get('app_domoprime_iso_'.$field.'_default',1));                          
             }
             if (!$this->getUser()->hasCredential(array(array('contract_new_request_remove_fields','meeting_new_request_remove_fields'))))
                { 
                 $this->setDefault('number_of_people', $this->getSettings()->get('app_domoprime_iso_number_of_fiscal_default',1));                 
                 $this->setDefault('revenue', $this->getSettings()->get('app_domoprime_iso_revenue_default',1));                 
                 $this->setDefault('number_of_fiscal',$this->getSettings()->get('app_domoprime_iso_number_of_fiscal_default',1));                 
                }           
        }
        elseif (!$this->getDefaults())
        {
             if ($this->hasValidator('occupation_id'))
             {    
                  $this->setDefault('occupation_id', $this->getSettings()->get('default_occupation_id'));
             }
         } 
    }
    
 
}


