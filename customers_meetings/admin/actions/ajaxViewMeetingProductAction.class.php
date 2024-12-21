<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingProductViewForm.class.php";



class customers_meetings_ajaxViewMeetingProductAction extends mfAction {
    
       
    
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                          
        $this->item=new  CustomerMeetingProduct($request->getPostParameter('MeetingProduct'));     
        $this->form=new CustomerMeetingProductViewForm();        
    }

}
