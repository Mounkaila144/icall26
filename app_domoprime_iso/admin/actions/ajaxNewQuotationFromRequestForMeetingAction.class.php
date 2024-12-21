<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeQuotationNewForMeetingForm.class.php";

class app_domoprime_iso_ajaxNewQuotationFromRequestForMeetingAction extends mfAction {
    
    const forward="ajaxListPartialQuotationFromRequestForMeeting";   
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
        $this->user=$this->getUser();
        $this->meeting=$request->getRequestParameter('meeting',new CustomerMeeting($request->getPostParameter('Meeting')));
        if ($this->meeting->isNotLoaded())
            return ;
        try
        {
            $this->quotation=new DomoprimeQuotation();               
            $this->form= new DomoprimeQuotationNewForMeetingForm($this->meeting,$request->getPostParameter('DomoprimeQuotation'));
            if (!$request->isMethod('POST') || !$request->getPostParameter('DomoprimeQuotation'))     
                return ;
            $this->form->bind($request->getPostParameter('DomoprimeQuotation'));
            if ($this->form->isValid())
            {
                //echo "<pre>"; var_dump($this->form->getValues()); echo "</pre>";             
                $this->quotation->createFromMeeting($this->meeting,$this->form,$this->getUser()->getGuardUser());
                $messages->addInfo(__('Quotation has been created'));
                $request->addRequestParameter('meeting', $this->meeting);
                $this->getEventDispather()->notify(new mfEvent($this->quotation, 'meeting.quotation.new'));  
                $this->forward($this->getModuleName(), static::forward);
            }   
            else
            {
                $messages->addError(__("Form has some errors."));
               // echo "<pre>";var_dump($this->form->getErrorSchema()->getErrorsMessage()); echo "</pre>";
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }

}
