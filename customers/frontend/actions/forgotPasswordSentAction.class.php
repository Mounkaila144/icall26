<?php


class customers_forgotPasswordSentAction extends mfAction {
    
     
    function execute(mfWebRequest $request) {
         $messages = mfMessages::getInstance();
         $this->email=$request->getRequestParameter('email');
         $this->model=CustomerSettings::load()->getForgotPasswordSentTextModel();             
    }
    
 
   
}


