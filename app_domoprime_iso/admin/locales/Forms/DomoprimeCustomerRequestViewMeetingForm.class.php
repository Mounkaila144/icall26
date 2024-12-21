<?php


 class DomoprimeCustomerRequestViewMeetingForm extends DomoprimeCustomerRequestBaseForm {
 
     protected $user=null,$meeting=null;
     
     function __construct($user,CustomerMeeting $meeting,$defaults = array(), $options = array()) {
         $this->user=$user;
         $this->meeting=$meeting;
         parent::__construct($defaults, $options);
     }
     
     function getMeeting()
     {
         return $this->meeting;
     }
     
     function getUser()
     {
         return $this->user;
     }
  
    function configure()
    {             
         parent::configure();
         if (!$this->getUser()->hasCredential(array(array('meeting_view_request_remove_fields'))))
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
         if ($this->getUser()->hasCredential(array(array('meeting_view_request_install_surface_wall'))))
            $this->setValidator('install_surface_wall',new mfValidatorI18nNumber(array('required'=>false)));
         if ($this->getUser()->hasCredential(array(array('meeting_view_request_install_surface_top'))))
            $this->setValidator('install_surface_top',new mfValidatorI18nNumber(array('required'=>false)));
         if ($this->getUser()->hasCredential(array(array('meeting_view_request_install_surface_floor'))))
            $this->setValidator('install_surface_floor',new mfValidatorI18nNumber(array('required'=>false)));
         if ($this->getUser()->hasCredential(array(array('meeting_view_request_parcel_surface'))))
            $this->setValidator('parcel_surface',new mfValidatorI18nNumber(array('required'=>false)));
         if ($this->getUser()->hasCredential(array(array('meeting_view_request_parcel_reference'))))
            $this->setValidator('parcel_reference',new mfValidatorString(array('required'=>false)));
        if ($this->getUser()->hasCredential(array(array('meeting_view_request_number_of_parts'))))
            $this->setValidator('number_of_parts',new mfValidatorI18nNumber(array('required'=>false)));
        if ($this->getUser()->hasCredential(array(array('meeting_view_request_surface_ite'))))
              $this->setValidator('surface_ite',new mfValidatorI18nNumber(array('required'=>false)));
        if ($this->getUser()->hasCredential(array(array('meeting_view_request_packboiler_quantity'))))
              $this->setValidator('packboiler_quantity',new mfValidatorI18nNumber(array('required'=>false)));
        if ($this->getUser()->hasCredential(array(array('meeting_view_request_boiler_quantity'))))
              $this->setValidator('boiler_quantity',new mfValidatorI18nNumber(array('required'=>false)));
         if ($this->getUser()->hasCredential(array(array('meeting_view_request_pack_quantity'))))
              $this->setValidator('pack_quantity',new mfValidatorI18nNumber(array('required'=>false)));
        if ($this->getUser()->hasCredential(array(array('meeting_view_request_ana_prime'))))
              $this->setValidator('ana_prime',new mfValidatorI18nNumber(array('required'=>false)));   
          if ($this->getUser()->hasCredential(array(array('meeting_view_request_surface_home'))))
              $this->setValidator('surface_home',new mfValidatorI18nNumber(array('required'=>false)));
         if ($this->getUser()->hasCredential(array(array('meeting_view_request_previous_energy'))))
              $this->setValidator('previous_energy_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(''=>'')+DomoprimePreviousEnergy::getEnergyForI18nSelect())));
          if ($this->getUser()->hasCredential(array(array('meeting_view_request_has_bbc'))))
              $this->setValidator('has_bbc',new mfValidatorBoolean(array('true'=>'Y','false'=>'N')));
         if ($this->getUser()->hasCredential(array(array('meeting_view_request_has_strainer'))))
              $this->setValidator('has_strainer',new mfValidatorBoolean(array('true'=>'Y','false'=>'N')));
         unset($this['id']);
    }
    
 
}


