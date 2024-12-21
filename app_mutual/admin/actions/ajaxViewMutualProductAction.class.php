<?php

require_once dirname(__FILE__)."/../locales/Forms/MutualProductViewForm.class.php";

class app_mutual_ajaxViewMutualProductAction extends mfAction {
         
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();     
        
        $this->item = new MutualProduct($request->getPostParameter('MutualProduct')); // new object       
        
        if ($this->item->isNotLoaded())
        {
            $messages->addError(__('Product is invalid.'));
            $this->forward ('app_mutual','ajaxListPartialMutualPartner');
        }
        
        $this->form = new MutualProductViewForm();       
    }

}
