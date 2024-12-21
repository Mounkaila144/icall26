<?php
 
class app_mutual_ajaxDeleteMutualPartnerContactAction extends mfAction {
    
    function execute(mfWebRequest $request) {    
        
        $messages = mfMessages::getInstance();   
        try 
        {    
            $item = new mfValidatorInteger();
            $id = $item->isValid($request->getPostParameter('MutualPartnerContact'));          
            $item = new MutualPartnerContact($id);           
            $item->delete();              
            $response = array("action"=>"DeleteMutualPartnerContact","id" =>$id,"info"=>__("MutualContact has been deleted."));
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

