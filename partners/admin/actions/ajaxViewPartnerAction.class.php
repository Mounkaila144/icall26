<?php

require_once dirname(__FILE__)."/../locales/Forms/PartnerViewForm.class.php";
 

class partners_ajaxViewPartnerAction extends mfAction {
    
        
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();    
        $this->item = new Partner($request->getPostParameter('Partner')); // new object       
        $this->form = new PartnerViewForm();  
       
    }

}
