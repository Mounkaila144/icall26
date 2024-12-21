<?php

class app_mutual_ajaxRemoveMutualPartnerAction extends mfAction {
    
    function execute(mfWebRequest $request) {  
        
        $messages = mfMessages::getInstance();   
        try 
        {         
            $item = new mfValidatorInteger();
            $id = $item->isValid($request->getPostParameter('MutualPartner'));          
            $item = new MutualPartner($id);           
            $item->delete();              
            $response = array("action"=>"RemoveMutualPartner","id" =>$id,"info"=>__("MutualPartner has been removed."));
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

