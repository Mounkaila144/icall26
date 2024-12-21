<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeQuotationViewForMeetingForm.class.php";

class app_domoprime_iso_ajaxSaveQuotationFromRequestForMeetingAction extends mfAction {
    
       
     const forward="ajaxListPartialQuotationFromRequestForMeeting";
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
        $this->user=$this->getUser();
        $this->meeting=$request->getRequestParameter('meeting',new CustomerMeeting($request->getPostParameter('Meeting')));
        if ($this->meeting->isNotLoaded())
            return ;
        $this->quotation=new DomoprimeQuotation($request->getPostParameter('DomoprimeQuotation'));
        $this->form= new DomoprimeQuotationViewForMeetingForm($this->quotation,$this->getUser(),$request->getPostParameter('DomoprimeQuotation'));
        if (!$request->isMethod('POST') || !$request->getPostParameter('DomoprimeQuotation'))     
            return ;
        $this->form->bind($request->getPostParameter('DomoprimeQuotation'));
        if ($this->form->isValid())
        {
            //echo "<pre>"; var_dump($this->form->getValues()); echo "</pre>";            
            $this->quotation->updateFromMeeting($this->form,$this->getUser()->getGuardUser());
            $messages->addInfo(__('Quotation has been updated'));
            $request->addRequestParameter('meeting', $this->meeting);
            $this->forward($this->getModuleName(), static::forward);
        }   
        else
        {
            $messages->addError(__("Form has some errors."));
           // echo "<pre>";var_dump($this->form->getErrorSchema()->getErrorsMessage()); echo "</pre>";
        }       
    }

}
