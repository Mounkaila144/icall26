<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingProductNewForm.class.php";

class customers_meetings_ajaxNewMeetingProductAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");  
        $this->meeting=new CustomerMeeting($request->getPostParameter('Meeting'),$this->site);  
        if ($this->meeting->isNotLoaded())
             return ;
        try
        {
            $this->item=new CustomerMeetingProduct(null,$this->site);
            $this->item->set('meeting_id',$this->meeting);
            $this->form=new CustomerMeetingProductNewForm($request->getPostParameter('MeetingProduct'),$this->site); 
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
