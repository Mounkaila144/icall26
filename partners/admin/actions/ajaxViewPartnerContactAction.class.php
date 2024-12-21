<?php

require_once dirname(__FILE__)."/../locales/Forms/PartnerContactViewForm.class.php";
 

class partners_ajaxViewPartnerContactAction extends mfAction {
    
        
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();     
        $this->item = new PartnerContact($request->getPostParameter('PartnerContact')); // new object       
        if ($this->item->isNotLoaded())
        {
            $messages->addError(__('Contact is invalid.'));
            $this->forward ('partners','ajaxListPartialPartner');
        }
        $this->form = new PartnerContactViewForm();       
    }

}
