<?php


class customers_emailSigninValidationAction extends mfAction {
    
     
    function execute(mfWebRequest $request) {
        $this->parametersToVariables();
        $this->company=SiteCompany::getSiteCompany(); 
        $this->url=url_to('customers',array('action'=>'ConfirmAccount'))."?email=".$this->validation->getUser()->get('email')."&key=".$this->validation->get('key');
    }
    
 
   
}


