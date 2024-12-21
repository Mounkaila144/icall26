<?php

class app_mutual_ajaxDeleteMutualProductCommissionAction extends mfAction {
    
    function execute(mfWebRequest $request) {  
        
        $messages = mfMessages::getInstance();   
        try 
        {         
            $item = new mfValidatorInteger();
            $id = $item->isValid($request->getPostParameter('MutualProductCommission'));          
            $item = new MutualProductCommission($id);           
            $item->disable();              
            $response = array("action"=>"DeleteMutualProductCommission","id" =>$id,"info"=>__("Commission has been deleted."));
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

