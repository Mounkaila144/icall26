<?php


require_once dirname(__FILE__)."/../locales/Forms/MyAccountForm.class.php";


class customers_ajaxMyAccountAction extends mfAction {
    
     
    function execute(mfWebRequest $request) {          
         $messages = mfMessages::getInstance();       
          if (!$this->getUser()->isAuthenticated() || !$this->getUser()->isCustomerUser())             
              $this->forwardTo401Action();
         $this->form=new MyAccountForm();
         $this->user=$this->getUser()->getGuardUser();             
    }
    
   
}


