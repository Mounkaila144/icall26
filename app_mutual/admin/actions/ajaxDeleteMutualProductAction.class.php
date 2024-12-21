<?php

class app_mutual_ajaxDeleteMutualProductAction extends mfAction {
    
    function execute(mfWebRequest $request) {  
        
        $messages = mfMessages::getInstance();   
        try 
        {         
            $item = new mfValidatorInteger();
            $id = $item->isValid($request->getPostParameter('MutualProduct'));          
            $item = new MutualProduct($id);           
            $item->disable();              
            $response = array("action"=>"DeleteMutualProduct","id" =>$id,"info"=>__("Product has been deleted."));
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

