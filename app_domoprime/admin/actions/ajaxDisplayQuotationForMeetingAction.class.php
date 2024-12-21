<?php


class app_domoprime_ajaxDisplayQuotationForMeetingAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
        $this->user=$this->getUser();               
        $this->item=new DomoprimeQuotation($request->getPostParameter('DomoprimeQuotation'));       
    }

}
