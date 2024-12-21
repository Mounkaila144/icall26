<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingProductNewForm.class.php";

class customers_meetings_ajaxNewMeetingProductAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();       
        $this->meeting=new CustomerMeeting($request->getPostParameter('Meeting'));  
        if ($this->meeting->isNotLoaded())
             return ;
        try
        {
            $this->item=new CustomerMeetingProduct();
            $this->item->set('meeting_id',$this->meeting);
            $this->form=new CustomerMeetingProductNewForm($request->getPostParameter('MeetingProduct')); 
            if ($request->isMethod('POST') && $request->getPostParameter('MeetingProduct'))
            {           
                $this->form->bind($request->getPostParameter('MeetingProduct'));
                if ($this->form->isValid())
                {
                    $this->item->add($this->form->getValues());                                        
                    $this->item->save();                    
                    $messages->addInfo(__("Product has been created."));
                    $request->addRequestParameter('meeting', $this->item->getMeeting());
                    $this->forward('customers_meetings', 'ajaxListMeetingProduct');
                }   
                else
                {
                     $messages->addError(__("Form has some errors."));
                     $this->item->add($this->form->getDefaults());
                }    
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }

}
