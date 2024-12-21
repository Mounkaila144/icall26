<?php

class MarketingLeadsWpFormsAllLeadsImportForm extends mfForm {
    
    protected $language=null,$user=null;
    
    function __construct($user,$defaults = array()) {
        $this->user=$user;
        $this->settings=MarketingLeadsWpSettings::load();
        parent::__construct($defaults);
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
        $this->language=$this->getSettings()->get('language','FR');
        $this->setOption('disabledCSRF',true);       
        $this->setValidators(array(
            "firstname"=>new mfValidatorString(array("max_length"=>"255","required"=>false)),
            "lastname"=>new mfValidatorString(array("max_length"=>"255","required"=>false)),          
            "address"=>new mfValidatorString(array("max_length"=>"255","required"=>false)), 
            "postcode"=>new mfValidatorString(array("max_length"=>"10","required"=>false)),       
            "city"=>new mfValidatorString(array("max_length"=>"255","required"=>false)),    
            "country"=>new mfValidatorChoiceCountry(array("required"=>false)),  
            "email"=>new mfValidatorEmail(array("required"=>false)),
            "phone"=>new mfValidatorPhoneString(array("max_length"=>"20","required"=>false)),
            "id_wp"=>new mfValidatorString(array("max_length"=>"64","required"=>false,'trim'=>true)),   
            "number_of_people"=>new mfValidatorInteger(array("required"=>false)), 
            "owner"=>new mfValidatorString(array("max_length"=>"64","required"=>false)), 
            "energy"=>new mfValidatorString(array("max_length"=>"64","required"=>false)), 
            "created_at"=>new mfValidatorI18nDate(array("with_time"=>true,'date_format'=>'aHM',"required"=>false),array('bad_format'=>__('{value} is bad format'))),
            "income"=>new mfValidatorI18nCurrency(array("required"=>false))
        ));  
        
        if($this->hasDefault("phone"))
            $this->phone->setOption('required',true);
        if($this->hasDefault("email"))
            $this->email->setOption('required',true);
        
        if ($this->getUser()->hasCredential(array(array('wp_leads_import_mobile_max'))))
            $this->phone->setOption('max_length','128');
        if ($this->getUser()->hasCredential(array(array('wp_leads_import_mobile_required'))))
            $this->phone->setOption('required',true);
        if ($this->getUser()->hasCredential(array(array('wp_leads_import_lastname_not_required'))))
            $this->lastname->setOption('required',false);
        if ($this->getUser()->hasCredential(array(array('wp_leads_import_postcode_not_required'))))
            $this->postcode->setOption('required',false);
        if ($this->getUser()->hasCredential(array(array('wp_leads_import_lastname_remove'))))
            unset($this['lastname']);     
        if ($this->getUser()->hasCredential(array(array('wp_leads_import_postcode_remove'))))
            unset($this['postcode']);
        $this->validatorSchema->setOption('keep_fields_unused',true);
        $this->validatorSchema->setMessage('field_missing',__('The field is missing.'));
        // propagate form to other module
//        mfContext::getInstance()->getEventManager()->notify(new mfEvent($this, 'wp.leads.import.model'));  
    }      
    
    function getFieldsI18n()
    {       
        $values=array(""=>__("-- Not affected --")); 
        foreach ($this->getFields() as $field)
        {
            $values[$field]=__($field,array(),'import','wp_form_leads_imports').($this->$field->getOption('required')?"*":"");
        }
        asort($values);
        return $values;
    }
    
    function reconfigure()
    {
        if (($this->hasDefault('created_at'))) {}
        else
           unset($this['created_at']); 
    }
    
    function getCreatedDateTime()
    {
        return $this->getValue('created_at');
    }
    
    function getWpFormLead()//WpFormLead
    {
        $lead=new MarketingLeadsWpForms(array('firstname'=> $this->getValue('firstname'),
                'lastname'=> $this->getValue('lastname'),
                'phone'=> $this->getValue('phone'),
                'address'=> $this->getValue('address'),
                'email'=> $this->getValue('email'),
                'postcode'=> $this->getValue('postcode'),
                'city'=> $this->getValue('city'),
                'country'=> $this->getValue('country'),
                'id_wp'=> $this->getValue('id_wp'),
                'number_of_people'=> $this->getValue('number_of_people'),
                'income'=> $this->getValue('income')
            ));
        if ($lead->isLoaded())
            return $lead;
        $this->setCreatedDateTime($lead); 
        $this->setOwner($lead); 
        $this->setEnergy($lead); 
        return $lead;
    }
    
    function hasField($field)
    {
        return isset($this->values[$field]);
    }
    
    function setCreatedDateTime($lead)
    {
        if ($this->hasField('created_at'))
        {
            $lead->set('created_at',$this->getCreatedDateTime());
        }
    }
    
    function setOwner($lead)
    {
        if ($this->hasField('owner'))
        {
            $lead->setOwner($this->getValue('owner'));
        }
    }
    
    function setEnergy($lead)
    {
        if ($this->hasField('energy'))
        {
            $lead->setEnergy($this->getValue('energy'));
        }
    }
}

