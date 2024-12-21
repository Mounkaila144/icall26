<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerSectorViewForm.class.php";
 

class customers_ajaxViewSectorAction extends mfAction {
    
        
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->item = new CustomerSector($request->getPostParameter('CustomerSector')); // new object       
        $this->form = new CustomerSectorViewForm();              
    }

}
