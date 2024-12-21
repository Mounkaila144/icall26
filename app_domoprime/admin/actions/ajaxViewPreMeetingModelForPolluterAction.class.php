<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimePolluterModelPreMeetingForm.class.php";

class app_domoprime_ajaxViewPreMeetingModelForPolluterAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();        
        $this->polluter=$request->getRequestParameter('polluter',new PartnerPolluterCompany($request->getPostParameter('Polluter')));
        if ($this->polluter->isNotLoaded())
            return ;
        $this->form= new DomoprimePolluterModelPreMeetingForm();
        $this->item=new DomoprimePolluterPreMeeting($this->polluter);
    }

}
