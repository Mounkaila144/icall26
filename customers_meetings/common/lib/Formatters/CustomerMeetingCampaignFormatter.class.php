<?php

class CustomerMeetingCampaignFormatter extends mfFormatter {
    
    
    function getCampaign()
    {
        return new mfString((string)$this->getValue());
    }
            
    function getOutput($tpl=""){
            return $this->getUser();

    }
    
}
