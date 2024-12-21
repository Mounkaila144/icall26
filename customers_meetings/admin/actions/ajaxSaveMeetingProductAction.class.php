<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingProductViewForm.class.php";



class customers_meetings_ajaxSaveMeetingProductAction extends mfAction {
    
       
    
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                           
        $this->item=new  CustomerMeetingProduct($request->getPostParameter('MeetingProduct'));     
        $this->form=new CustomerMeetingProductViewForm($request->getPostParameter('MeetingProduct')); 
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
