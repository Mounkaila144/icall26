<?php

class app_mutual_ajaxDeleteMutualProductForMeetingAction extends mfAction {
    
    function execute(mfWebRequest $request) {  
        
        $messages = mfMessages::getInstance();   
        try 
        {         
            $meeting = new CustomerMeeting($request->getPostParameter("Meeting"));
            if($meeting->isNotLoaded())
                throw new mfException("Meeting is not loaded");
            $item = new mfValidatorInteger();
            $id = $item->isValid($request->getPostParameter('CustomerMeetingMutualProduct'));          
            $item = new CustomerMeetingMutualProduct($id);           
            $item->delete();              
            $response = array("action"=>"DeleteCustomerMeetingMutualProduct","id" =>$id,"info"=>__("Product has been deleted."));
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

