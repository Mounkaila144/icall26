<?php

require_once __DIR__."/../locales/Forms/MutualProductsForMeeting/NewMutualProductForMeetingForm.class.php";

class app_mutual_ajaxNewProductForMeetingAction extends mfAction {
    
    function execute(mfWebRequest $request) {   
        
        $messages = mfMessages::getInstance();   
        $this->meeting = $request->getRequestParameter('meeting', new CustomerMeeting($request->getPostParameter('Meeting')));
        $this->key=$request->getPostParameter('key');       
        $this->form=new NewMutualProductForMeetingForm($this->meeting,$request->getPostParameter('CustomerMeetingMutualProduct'));                   
        $this->user=$this->getUser();           
    }
    
}

