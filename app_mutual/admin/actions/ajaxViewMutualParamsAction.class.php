<?php

require_once dirname(__FILE__)."/../locales/Forms/MutualPartnerParamsViewForm.class.php";
 
class app_mutual_ajaxViewMutualParamsAction extends mfAction {
    
    function execute(mfWebRequest $request) {  
        
        $messages = mfMessages::getInstance();     
        $this->mutual = new MutualPartner($request->getPostParameter('MutualPartner')); // new object       
        if ($this->mutual->isNotLoaded())
        {
            $messages->addError(__('Mutual is invalid.'));
            $this->forward ('app_mutual','ajaxListPartialMutualPartner');
        }        
        $this->item = new MutualPartnerParams($this->mutual);        
        $this->form = new MutualPartnerParamsViewForm();            
    }

}
