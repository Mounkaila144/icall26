<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerUserForCompanyForm.class.php";

class customers_ajaxViewUserForCompanyAction extends mfAction {

               
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();       
        $this->user=$this->getUser();  
        $this->customer_settings=  CustomerSettings::load();
        $this->form= new CustomerUserForCompanyNewForm($this->getUser(),$request->getPostParameter('CustomerUser'));                    
        $this->item=new CustomerUser($request->getPostParameter('CustomerUser'),$this->user->getGuardUser());      
    }
    
}    


