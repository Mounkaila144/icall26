<?php


class CustomerMeetingCampaignNewForm extends CustomerMeetingCampaignBaseForm {
    
   
     function configure() {              
        parent::configure();
        unset($this['id']);        
     }
    
}


