<?php




class customers_ajaxNewMyAddressAction extends mfAction {
    
     
    function execute(mfWebRequest $request) {                  
         if (!$this->getUser()->isAuthenticated() || !$this->getUser()->isCustomerUser())             
            $this->forwardTo401Action();
        $messages = mfMessages::getInstance();     
        $this->user=$this->getUser();
       
    }          
    
   
}


