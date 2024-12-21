<?php

require_once dirname(__FILE__)."/../locales/Forms/CallcenterViewForm.class.php";
 

class users_ajaxViewCallcenterAction extends mfAction {
    
        
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->item = new Callcenter($request->getPostParameter('Callcenter')); // new object       
        $this->form = new CallcenterViewForm();              
    }

}
