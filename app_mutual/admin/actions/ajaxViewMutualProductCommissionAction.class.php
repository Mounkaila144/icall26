<?php

require_once dirname(__FILE__)."/../locales/Forms/MutualProductCommissionViewForm.class.php";

class app_mutual_ajaxViewMutualProductCommissionAction extends mfAction {
         
    function execute(mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();     
        
        $this->item = new MutualProductCommission($request->getPostParameter('MutualProductCommission')); // new object       
        
        if ($this->item->isNotLoaded())
        {
            $messages->addError(__('Commission is invalid.'));
            $this->forward ('app_mutual','ajaxListPartialMutualPartner');
        }
        
        $this->form = new MutualProductCommissionViewForm();       
    }

}
