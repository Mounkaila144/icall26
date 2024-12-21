<?php

require_once dirname(__FILE__)."/../locales/Forms/PartnerViewForm.class.php";
 

class partners_ajaxViewPartnerAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"sites","Admin");
        $this->item = new Partner($request->getPostParameter('Partner'),$this->site); // new object       
        $this->form = new PartnerViewForm();  
       // var_dump($this->item);
    }

}
