<?php

class app_mutual_ajaxRemoveMutualProductDecommissionAction extends mfAction {
    
    function execute(mfWebRequest $request) {  
        
        $messages = mfMessages::getInstance();   
        try 
        {         
            $item = new mfValidatorInteger();
            $id = $item->isValid($request->getPostParameter('MutualProductDecommission'));          
            $item = new MutualProductDecommission($id);           
            $item->delete();              
            $response = array("action"=>"RemoveMutualProductDecommission","id" =>$id,"info"=>__("MutualProductDecommission has been removed."));
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

