<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingProductViewForm.class.php";



class customers_meetings_ajaxViewMeetingProductAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");                 
        $this->item=new  CustomerMeetingProduct($request->getPostParameter('MeetingProduct'),$this->site);     
        $this->form=new CustomerMeetingProductViewForm(array(),$this->site);        
    }

}
