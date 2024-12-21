<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeSubventionTypeViewForm.class.php";

class app_domoprime_ajaxViewTypeAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                  
         $this->form= new DomoprimeSubventionTypeViewForm($request->getPostParameter('DomoprimeSubventionType'));
        $this->item=new DomoprimeSubventionType($request->getPostParameter('DomoprimeSubventionType'));         
    }

}
