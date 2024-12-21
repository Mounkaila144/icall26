<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingCreateForm.class.php";



class customers_meetings_ajaxCreateMeetingFromExternalAction extends mfAction {
    
    
         
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                    
        $this->user=$this->getUser();           
        $form = new CustomerMeetingCreateForm($request->getPostParameter('ExternalMeeting'));
        $form->bind($request->getPostParameter('ExternalMeeting'));
        if (!$form->isValid())
            $messages->addWarning(__('Some errors occur during transfer.'));        
        $request->addRequestParameter('Meeting',$form->getValues());
        $this->forward('customers_meetings','ajaxNewMeeting');        
    }

}
