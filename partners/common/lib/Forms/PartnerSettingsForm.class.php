<?php



 class PartnerSettingsForm extends mfFormSite {
 
    function __construct($site=null) {       
        parent::__construct(array(),array(),$site);
    }
  
    function configure()
    {        
        $this->setValidators(array(                                   
            "partner_group_id"=>new mfValidatorChoice(array("key"=>true,"required"=>false,"choices"=>GroupUtils::getAdminGroupsForSelect($this->getSite())->toArray())),                        
            ) 
        );                               
    }
        
 
}


