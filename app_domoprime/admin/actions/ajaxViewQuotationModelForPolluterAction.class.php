<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimePolluterModelQuotationForm.class.php";

class app_domoprime_ajaxViewQuotationModelForPolluterAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();        
        $this->polluter=$request->getRequestParameter('polluter',new PartnerPolluterCompany($request->getPostParameter('Polluter')));
        if ($this->polluter->isNotLoaded())
            return ;
        $this->form= new DomoprimePolluterModelQuotationForm();
        $this->item=new DomoprimePolluterQuotation($this->polluter);
        // echo $this->item->get('id');
    }

}
