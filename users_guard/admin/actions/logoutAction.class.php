<?php


class users_guard_logoutAction extends mfAction {
    
     
    function execute(mfWebRequest $request) {                
         $this->getUser()->signOut();
         $this->redirect("/");        
    }
    
   
}


