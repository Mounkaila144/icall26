<?php

class marketing_leads_ajaxDeleteWpFormsAction extends mfAction {
    
    function execute(mfWebRequest $request) {  
        
        $messages = mfMessages::getInstance();   
        try 
        {         
            $item = new mfValidatorInteger();
            $id = $item->isValid($request->getPostParameter('WpForms'));          
            $item = new MarketingLeadsWpForms($id);           
            $item->disable();              
            $response = array("action"=>"DeleteWpForms","id" =>$id,"info"=>__("Form has been deleted."));
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

