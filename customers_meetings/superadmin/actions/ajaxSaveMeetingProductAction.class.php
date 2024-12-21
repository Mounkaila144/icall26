<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingProductViewForm.class.php";



class customers_meetings_ajaxSaveMeetingProductAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");                 
        $this->item=new  CustomerMeetingProduct($request->getPostParameter('MeetingProduct'),$this->site);     
        $this->form=new CustomerMeetingProductViewForm($request->getPostParameter('MeetingProduct'),$this->site); 
        if ($request->isMethod('POST') && $request->getPostParameter('MeetingProduct'))
        {
            $this->form->bind($request->getPostParameter('MeetingProduct'));
            if ($this->form->isValid())
            {
                 $this->item->add($this->form->getValues());
                 $this->item->save();
                 $messages->addInfo(__("Product has been updated."));
                 $request->addRequestParameter('meeting', $this->item->getMeeting());
                 $this->forward('customers_meetings', 'ajaxListMeetingProduct');
            }   
            else
            {
                $messages->addError(__("Form has some errors."));
                $this->item->add($this->form->getDefaults());
                 //var_dump($this->form->getErrorSchema()->getErrorsMessage());
            }    
        }    
    }

}
