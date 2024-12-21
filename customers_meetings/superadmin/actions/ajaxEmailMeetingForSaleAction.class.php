<?php

require_once dirname(__FILE__)."/../locales/Forms/MeetingSaleForm.class.php";

class customers_meetings_ajaxEmailMeetingForSaleAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
   
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");                     
        $this->item=new CustomerMeeting($request->getPostParameter('Meeting'),$this->site); 
        $this->country=$this->getUser()->getCountry();
        if ($this->item->isNotLoaded())
            return ;
        $this->form=new MeetingSaleForm();
        $this->form->bind($request->getPostParameter('MeetingEmailSale'));
        if ($this->form->isValid())
        {
            $this->user=($this->form['sale']->getValue()=='Sale1')?$this->item->getSale():$this->item->getSale2();
            if (!$this->user->get('email'))
                  $messages->addWarning(__("Email doesn't exist, you have to complete it."));            
        }          
    }

}
