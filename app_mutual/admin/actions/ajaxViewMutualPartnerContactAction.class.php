<?php

require_once dirname(__FILE__)."/../locales/Forms/MutualPartnerContactViewForm.class.php";
 
class app_mutual_ajaxViewMutualPartnerContactAction extends mfAction {
    
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();     
        $this->item = new MutualPartnerContact($request->getPostParameter('MutualPartnerContact')); // new object       
        if ($this->item->isNotLoaded())
        {
            $messages->addError(__('Contact is invalid.'));
            $this->forward ('app_mutual','ajaxListPartialMutualPartner');
        }
        $this->form = new MutualPartnerContactViewForm();       
    }

}
