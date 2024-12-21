<?php

require_once dirname(__FILE__)."/../locales/Forms/MeetingSaleForm.class.php";


class customers_meetings_ajaxSmsMeetingForSaleAction extends mfAction {
    
       
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
                           
        $this->item=new CustomerMeeting($request->getPostParameter('Meeting'));   
        $this->form=new MeetingSaleForm();
        $this->form->bind($request->getPostParameter('MeetingSaleSMS'));
        if ($this->form->isValid())
        {
            $this->user=($this->form['sale']->getValue()=='Sale1')?$this->item->getSale():$this->item->getSale2();
            if (!$this->user->get('mobile'))
                  $messages->addWarning(__("Mobile doesn't exist, you have to complete it."));            
        }       
    }

}
