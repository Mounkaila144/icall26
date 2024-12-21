<?php

require_once dirname(__FILE__).'/../locales/Forms/CustomerContractPollutingContactViewForm.class.php';

class app_domoprime_ajaxViewPollutingContactAction extends mfAction{
    
    function execute(mfWebRequest $request){
        
        $messages = mfMessages::getInstance();     
        $this->item = new DomoprimePollutingContact($request->getPostParameter('PollutingContact')); // new object       
        if ($this->item->isNotLoaded())
        {
            $messages->addError(__('Contact is invalid.'));
            $this->forward ('app_domoprime','ajaxListPartialPollutingCompany');
        }
        $this->form = new CustomerContractPollutingContactViewForm();
    }
    
}
