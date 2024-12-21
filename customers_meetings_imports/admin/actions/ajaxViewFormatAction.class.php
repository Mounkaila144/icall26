<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingViewFormatForm.class.php";
require_once dirname(__FILE__)."/../locales/Imports/CustomerMeetingImport.class.php";

class customers_meetings_imports_ajaxViewFormatAction extends mfAction {
    
       
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();            
        $this->format=new CustomerMeetingImportFormat($request->getPostParameter('CustomerMeetingImportFormat'));      
        if ($this->format->isNotLoaded())
        {
            $messages->addError(__('Format is invalid'));
            $this->forward('customers_meetings_imports','ajaxListPartialFormat');
        }        
        $this->form=new CustomerMeetingViewFormatForm($this->getUser(),array('fields'=>$this->format->getNamesValues()));          
    }
}


