<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingCampaignViewForm.class.php";
 

class customers_meetings_ajaxViewCampaignAction extends mfAction {
    
        
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->item = new CustomerMeetingCampaign($request->getPostParameter('CustomerMeetingCampaign')); // new object       
        $this->form = new CustomerMeetingCampaignViewForm();              
    }

}
