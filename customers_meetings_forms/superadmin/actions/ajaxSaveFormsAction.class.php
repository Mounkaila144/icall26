<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingViewForms.class.php";        

class customers_meetings_forms_ajaxSaveFormsAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
            
    function execute(mfWebRequest $request) {                     
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE); 
        $this->meeting=new CustomerMeeting($request->getPostParameter('MeetingForms'),$this->site);
        if ($this->meeting->isNotLoaded())
            return ;
        $this->form=new CustomerMeetingViewForms($this->meeting,$request->getPostParameter('MeetingForms'));   
        try
        {               
           // echo "<pre>"; var_dump($request->getPostParameter('MeetingForms')); echo "</pre>";
            $this->form->bind($request->getPostParameter('MeetingForms'));
            if ($this->form->isValid())
            {              
               // $this->form->getForms();                                              
                $this->form->getForms()->save();
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
