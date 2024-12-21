<?php

class app_domoprime_ajaxListPollutingContactAction extends mfAction {
    
    function execute(mfWebRequest $request) { 
            
        $messages = mfMessages::getInstance();     
        $this->item=$request->getRequestParameter('DomoprimePolluting', new PartnerPolluterCompany($request->getPostParameter('DomoprimePolluting'))); 
    }
}
