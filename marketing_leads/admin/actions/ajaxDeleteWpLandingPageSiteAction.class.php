<?php

class marketing_leads_ajaxDeleteWpLandingPageSiteAction extends mfAction {
    
    function execute(mfWebRequest $request) {  
        
        $messages = mfMessages::getInstance();   
        try 
        {         
            $item = new mfValidatorInteger();
            $id = $item->isValid($request->getPostParameter('WpLandingPageSite'));          
            $item = new MarketingLeadsWpLandingPageSite($id);           
            $item->disable();              
            $response = array("action"=>"DeleteWpLandingPageSite","id" =>$id,"info"=>__("Landing page site has been deleted."));
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

