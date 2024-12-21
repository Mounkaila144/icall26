<?php

require_once dirname(__FILE__).'/../locales/Forms/MutualProductsForMeeting/NewMutualProductForMeetingForm.class.php';

class app_mutual_ProductsMutualActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {              
        $this->meeting = $this->getParameter("meeting");
        $this->mutuals = MutualPartner::getProductsWithMutual($this->meeting);
        $this->form = new NewMutualProductForMeetingForm($this->meeting);
    } 
    
}