<?php


class users_apiGetUserAction extends mfAction {
   
    public function execute(\mfWebRequest $request) {
        
        $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*');
        $response=array();
        $messages = mfMessages::getInstance();     
        try 
        {
            return $response = array("action"=>"GetUser","User"=>$this->getUser()->getGuardUser()->toArrayForProfileApi());
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
