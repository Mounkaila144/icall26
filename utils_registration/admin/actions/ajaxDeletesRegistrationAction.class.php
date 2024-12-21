<?php

class utils_registration_ajaxDeletesRegistrationAction extends mfAction {
    
    public function execute(\mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();   
        try 
        {          
            $validator=new mfValidatorSchemaForEach(new mfValidatorInteger(),count($request->getPostParameter('selection')));
            $validator->isValid($request->getPostParameter('selection'));
            $products= new UtilsRegistrationCollection($request->getPostParameter('selection'));
            $products->delete();                              
            $response = array("action"=>"DeleteRegistrations","info"=>__("Registrations has been deleted."),"parameters" =>$request->getPostParameter('selection'));
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }


}
