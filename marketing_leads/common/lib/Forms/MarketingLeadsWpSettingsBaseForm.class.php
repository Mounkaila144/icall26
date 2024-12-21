<?php

class MarketingLeadsWpSettingsBaseForm extends mfFormSite {
 
    function __construct($site=null) {       
        parent::__construct(array(),array(),$site);
    }
  
    function configure()
    {
        $this->setValidators(array(            
                "max_leads_to_fetch"=>new mfValidatorInteger(array()),
                "state"=>new mfValidatorChoice(array("choices"=> CustomerMeetingStatus::getStatusWithI18nForSelect()->toArray(),"key"=>true)),
                "default_state"=>new mfValidatorChoice(array("choices"=> MarketingLeadsWpFormsStatus::getStatusWithI18nForSelect()->unshift(array(''=>''))->toArray(),'required'=>false,"key"=>true)),
                "blacklist_phones_list"=>new mfValidatorMultiple(new mfValidatorPhoneString(),array('required'=>false)),
                "sended_state"=>new mfValidatorChoice(array("choices"=> MarketingLeadsWpFormsStatus::getStatusWithI18nForSelect()->unshift(array(''=>''))->toArray(),'required'=>true,"key"=>true)),
            ) 
        );                      
    }
 
}


