<?php

require_once dirname(__FILE__)."/../locales/Forms/MutualProductDecommissionViewForm.class.php";

class app_mutual_ajaxViewMutualProductDecommissionAction extends mfAction {
         
    function execute(mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();     
        
        $this->item = new MutualProductDecommission($request->getPostParameter('MutualProductDecommission')); // new object       
        
        if ($this->item->isNotLoaded())
        {
            $messages->addError(__('Decommission is invalid.'));
            $this->forward ('app_mutual','ajaxListPartialMutualPartner');
        }
        
        $this->form = new MutualProductDecommissionViewForm();       
    }

}
