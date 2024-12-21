<?php

class app_mutual_ajaxRemoveMutualProductAction extends mfAction {
    
    function execute(mfWebRequest $request) {  
        
        $messages = mfMessages::getInstance();   
        try 
        {         
            $item = new mfValidatorInteger();
            $id = $item->isValid($request->getPostParameter('MutualProduct'));          
            $item = new MutualProduct($id);           
            $item->delete();              
            $response = array("action"=>"RemoveMutualProduct","id" =>$id,"info"=>__("MutualProduct has been removed."));
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

