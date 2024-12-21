<?php

require_once dirname(__FILE__)."/../locales/Forms/PartnerContactViewForm.class.php";
 

class partners_ajaxViewPartnerContactAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"sites","Admin");
        $this->item = new PartnerContact($request->getPostParameter('PartnerContact'),$this->site); // new object       
        if ($this->item->isNotLoaded())
        {
            $messages->addError(__('Contact is invalid.'));
            $this->forward ('partners','ajaxListPartialPartner');
        }
        $this->form = new PartnerContactViewForm();       
    }

}
