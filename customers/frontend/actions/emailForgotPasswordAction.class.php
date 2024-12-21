<?php


class customers_emailForgotPasswordAction extends mfAction {
    
     
    function execute(mfWebRequest $request) {
        $this->parametersToVariables();
        $this->company=SiteCompany::getSiteCompany();             
    }
    
 
   
}


