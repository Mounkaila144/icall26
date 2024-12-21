<?php

class app_mutual_ajaxDeleteMutualPartnerAction extends mfAction {
    
    function execute(mfWebRequest $request) {  
        
        $messages = mfMessages::getInstance();   
        try 
        {         
            $item = new mfValidatorInteger();
            $id = $item->isValid($request->getPostParameter('MutualPartner'));          
            $item = new MutualPartner($id);           
            $item->disable();              
            $response = array("action"=>"DeleteMutualPartner","id" =>$id,"info"=>__("MutualPartner has been deleted."));
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

