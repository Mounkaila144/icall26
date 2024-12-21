<?php


 class DomoprimeCustomerRequestViewForm extends DomoprimeCustomerRequestBaseForm {
 
     protected $user=null;
     
     function __construct($user,$defaults = array(), $options = array()) {
         $this->user=$user;
         parent::__construct($defaults, $options);
     }
     
     function getUser()
     {
         return $this->user;
     }
     
     function getSettings()
     {
         return $this->settings=$this->settings===null?new DomoprimeIsoSettings():$this->settings;
     }
  
    function configure()
    {       
         parent::configure();
         if (!$this->getUser()->hasCredential(array(array('contract_view_request_remove_fields','meeting_view_request_remove_fields'))))
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
         if ($this->getUser()->hasCredential(array(array('contract_view_request_install_surface_wall','meeting_view_request_install_surface_wall'))))
            $this->setValidator('install_surface_wall',new mfValidatorI18nNumber(array('required'=>false)));
         if ($this->getUser()->hasCredential(array(array('contract_view_request_install_surface_top','meeting_view_request_install_surface_top'))))
            $this->setValidator('install_surface_top',new mfValidatorI18nNumber(array('required'=>false)));
         if ($this->getUser()->hasCredential(array(array('contract_view_request_install_surface_floor','meeting_view_request_install_surface_floor'))))
            $this->setValidator('install_surface_floor',new mfValidatorI18nNumber(array('required'=>false)));
         if ($this->getUser()->hasCredential(array(array('contract_view_request_parcel_surface','meeting_view_request_parcel_surface'))))
            $this->setValidator('parcel_surface',new mfValidatorI18nNumber(array('required'=>false)));
         if ($this->getUser()->hasCredential(array(array('contract_view_request_parcel_reference','meeting_view_request_parcel_reference'))))
            $this->setValidator('parcel_reference',new mfValidatorString(array('required'=>false)));
        if ($this->getUser()->hasCredential(array(array('contract_view_request_number_of_parts'))))
             $this->setValidator('number_of_parts',new mfValidatorI18nNumber(array('required'=>false)));
        if ($this->getUser()->hasCredential(array(array('contract_view_request_surface_ite'))))
             $this->setValidator('surface_ite',new mfValidatorI18nNumber(array('required'=>false)));
        if ($this->getUser()->hasCredential(array(array('contract_view_request_packboiler_quantity'))))
              $this->setValidator('packboiler_quantity',new mfValidatorI18nNumber(array('required'=>false)));
        if ($this->getUser()->hasCredential(array(array('contract_view_request_boiler_quantity'))))
              $this->setValidator('boiler_quantity',new mfValidatorI18nNumber(array('required'=>false)));
         if ($this->getUser()->hasCredential(array(array('contract_view_request_pack_quantity'))))
              $this->setValidator('pack_quantity',new mfValidatorI18nNumber(array('required'=>false)));
         if ($this->getUser()->hasCredential(array(array('contract_view_request_ana_prime'))))
              $this->setValidator('ana_prime',new mfValidatorI18nNumber(array('required'=>false)));
         if ($this->getUser()->hasCredential(array(array('contract_view_request_surface_home'))))
              $this->setValidator('surface_home',new mfValidatorI18nNumber(array('required'=>false,'empty_value'=>0.0)));
         if ($this->getUser()->hasCredential(array(array('contract_view_request_previous_energy'))))
              $this->setValidator('previous_energy_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>
                  $this->getUser()->hasCredential(array(array('contract_meeting_previous_energy_default_value')))?
                  DomoprimePreviousEnergy::getEnergyForI18nSelect():Array(''=>'')+DomoprimePreviousEnergy::getEnergyForI18nSelect())));
          if ($this->getUser()->hasCredential(array(array('contract_view_request_has_bbc'))))
              $this->setValidator('has_bbc',new mfValidatorBoolean(array('true'=>'Y','false'=>'N')));
         if ($this->getUser()->hasCredential(array(array('contract_view_request_has_strainer'))))
              $this->setValidator('has_strainer',new mfValidatorBoolean(array('true'=>'Y','false'=>'N')));
         if ($this->getUser()->hasCredential(array(array('contract_view_request_cef'))))
              $this->setValidator('cef',new mfValidatorI18nNumber(array('required'=>false)));
         if ($this->getUser()->hasCredential(array(array('contract_new_request_cef_project'))))
              $this->setValidator('cef_project',new mfValidatorI18nNumber(array('required'=>false)));
         if ($this->getUser()->hasCredential(array(array('contract_view_request_cep'))))
              $this->setValidator('cep',new mfValidatorI18nNumber(array('required'=>false)));
         if ($this->getUser()->hasCredential(array(array('contract_view_request_cep_project'))))      
              $this->setValidator('cep_project',new mfValidatorI18nNumber(array('required'=>false)));                                       
        if ($this->getUser()->hasCredential(array(array('contract_view_request_previous_energy_class'))))         
              $this->setValidator('previous_energy_class',new mfValidatorChoice(array('key'=>true,'choices'=>$this->getSettings()->getEnergyClasses()->unshift(array(''=>'')),'required'=>false,'empty_value'=>null)));                      
        if ($this->getUser()->hasCredential(array(array('contract_view_request_request_energy_class'))))
              $this->setValidator('energy_class',new mfValidatorChoice(array('key'=>true,'choices'=>$this->getSettings()->getEnergyClasses()->unshift(array(''=>'')),'required'=>false,'empty_value'=>null)));             
         unset($this['id']);                         
         if ($this->getUser()->hasCredential(array(array('contract_meeting_request_default_value'))) && !$this->getDefaults())    
        {                     
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
    }
    
 
}


