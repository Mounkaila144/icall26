<?php

class app_mutual_ajaxDeleteMutualProductDecommissionAction extends mfAction {
    
    function execute(mfWebRequest $request) {  
        
        $messages = mfMessages::getInstance();   
        try 
        {         
            $item = new mfValidatorInteger();
            $id = $item->isValid($request->getPostParameter('MutualProductDecommission'));          
            $item = new MutualProductDecommission($id);           
            $item->disable();              
            $response = array("action"=>"DeleteMutualProductDecommission","id" =>$id,"info"=>__("Decommission has been deleted."));
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

