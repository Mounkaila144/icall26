<?php

class app_mutual_ajaxRemoveMutualProductCommissionAction extends mfAction {
    
    function execute(mfWebRequest $request) {  
        
        $messages = mfMessages::getInstance();   
        try 
        {         
            $item = new mfValidatorInteger();
            $id = $item->isValid($request->getPostParameter('MutualProductCommission'));          
            $item = new MutualProductCommission($id);           
            $item->delete();              
            $response = array("action"=>"RemoveMutualProductCommission","id" =>$id,"info"=>__("MutualProductCommission has been removed."));
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

