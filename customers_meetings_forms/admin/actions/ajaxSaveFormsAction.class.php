<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingViewForms.class.php";        

class customers_meetings_forms_ajaxSaveFormsAction extends mfAction {
    
           
    function execute(mfWebRequest $request) {                     
        $messages = mfMessages::getInstance();       
        $this->meeting=new CustomerMeeting($request->getPostParameter('MeetingForms'));
        if ($this->meeting->isNotLoaded())
            return ;          
        $this->form=new CustomerMeetingViewForms($this->getUser(),$this->meeting,$request->getPostParameter('MeetingForms'));   
        if ($this->meeting->isHold())
        {    
             $messages->addWarning(__('Meeting is hold.')); 
             return ;
        }  
        try
        {                
            $this->form->bind($request->getPostParameter('MeetingForms'));
            if ($this->form->isValid())
            {              
                $this->form->getForms();                                              
                $this->form->getForms()->save();
                $this->getEventDispather()->notify(new mfEvent($this->form->getForms(), 'meeting.form.update'));  
                $messages->addInfo(__("Information has been saved."));              
            }   
            else
            {               
                // Repopulate               
                $messages->addError(__("Form has some errors."));               
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }         
    }

}
