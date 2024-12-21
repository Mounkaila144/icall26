<?php



class partners_ajaxListPartnerContactAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"sites","Admin");
        $this->item=$request->getRequestParameter('Partner', new Partner($request->getPostParameter('Partner'),$this->site)); 
    }

}
