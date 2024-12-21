<?php

class app_mutual_ajaxListMutualPartnerContactAction extends mfAction {
    
    function execute(mfWebRequest $request) {        
        
        $messages = mfMessages::getInstance();      
        $this->item=$request->getRequestParameter('MutualPartner', new MutualPartner($request->getPostParameter('MutualPartner')));
    }
}
