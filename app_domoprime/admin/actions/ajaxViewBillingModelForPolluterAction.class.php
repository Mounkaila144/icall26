<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimePolluterModelBillingForm.class.php";

class app_domoprime_ajaxViewBillingModelForPolluterAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();        
        $this->polluter=$request->getRequestParameter('polluter',new PartnerPolluterCompany($request->getPostParameter('Polluter')));
        if ($this->polluter->isNotLoaded())
            return ;
        $this->form= new DomoprimePolluterModelBillingForm();
        $this->item=new DomoprimePolluterBilling($this->polluter);
    }

}
