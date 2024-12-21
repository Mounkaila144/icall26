<?php
require_once dirname(__FILE__).'/../locales/Forms/CustomerContractPollutingViewForm.class.php';

class app_domoprime_ajaxViewPollutingCompanyAction extends mfAction{
    
    function execute(mfWebRequest $request){
        
        $messages = mfMessages::getInstance();     
        $this->item = new DomoprimePollutingCompany($request->getPostParameter('Polluting')); // new object       
        $this->form = new CustomerContractPollutingViewForm($this->getUser()); 
        $this->getEventDispather()->notify(new mfEvent($this->form, 'polluter.view.form'));     
    }
    
}
