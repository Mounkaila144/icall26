<?php



class partners_ajaxListPartnerContactAction extends mfAction {
    
        
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->item=$request->getRequestParameter('Partner', new Partner($request->getPostParameter('Partner'))); 
    }

}
