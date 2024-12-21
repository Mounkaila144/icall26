<?php

require_once dirname(__FILE__)."/../locales/Forms/MeetingSaleForm.class.php";


class customers_meetings_ajaxSmsMeetingForSaleAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");                      
        $this->item=new CustomerMeeting($request->getPostParameter('Meeting'),$this->site);   
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
