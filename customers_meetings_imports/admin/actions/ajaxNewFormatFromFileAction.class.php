<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingFormatFileForm.class.php";

class customers_meetings_imports_ajaxNewFormatFromFileAction extends mfAction {
    
       
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();                     
        $this->form=$request->getRequestParameter('form',new CustomerMeetingFormatFileForm($request->getPostParameter('CustomerMeetingFormat')));
    }
}

