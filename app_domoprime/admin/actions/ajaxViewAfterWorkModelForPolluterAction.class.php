<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimePolluterModelAfterWorkForm.class.php";

class app_domoprime_ajaxViewAfterWorkModelForPolluterAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();        
        $this->polluter=$request->getRequestParameter('polluter',new PartnerPolluterCompany($request->getPostParameter('Polluter')));
        if ($this->polluter->isNotLoaded())
            return ;
        $this->form= new DomoprimePolluterModelAfterWorkForm();
        $this->item=new DomoprimePolluterAfterWork($this->polluter);
    }

}
