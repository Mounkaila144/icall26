<?php

require_once dirname(__FILE__)."/../locales/Forms/MutualPartnerViewForm.class.php";
 

class app_mutual_ajaxViewMutualPartnerAction extends mfAction {
    
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();    
        $this->item = new MutualPartner($request->getPostParameter('MutualPartner')); // new object       
        $this->form = new MutualPartnerViewForm();  
    }

}
