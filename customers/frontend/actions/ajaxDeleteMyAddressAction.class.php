<?php


class customers_ajaxDeleteMyAddressAction extends mfAction {

    function execute(mfWebRequest $request) {     
        if (!$this->getUser()->isAuthenticated() || !$this->getUser()->isCustomerUser())             
            $this->forwardTo401Action();
        $messages = mfMessages::getInstance();    
        $this->user=$this->getUser();
       // CustomerAddress
        $response=array('info'=>__("Address has been deleted."),'action'=>'DeleteMyAddress');
        return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    } 
    
}

