<?php
/* 
 * Warning : This component must be used with /userGuard/identification component
 */
class userGuard_loginOnlyActionComponent extends mfActionComponent {
            
    function execute(mfWebRequest $request) {        
        $messages = mfMessages::getInstance();       
        if ($this->getUser()->isAuthenticated())  
            return mfView::NONE;            
        $this->form = new customerGuardForm();   
        if ($request->isMethod('post')) 
        {
            $this->form->bind($request->getPostParameter('signin'));            
        }
    } 
    
    
}
