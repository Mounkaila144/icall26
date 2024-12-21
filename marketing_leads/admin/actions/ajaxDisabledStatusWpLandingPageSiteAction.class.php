<?php

class marketing_leads_ajaxDisabledStatusWpLandingPageSiteAction extends mfAction {
    
    function execute(mfWebRequest $request) {     
        $messages = mfMessages::getInstance();   
        try 
        {         
            $validator = new mfValidatorInteger();
            $landing_page_site = new MarketingLeadsWpLandingPageSite($validator->isValid($request->getPostParameter('WpLandingPageSite')));
            if ($landing_page_site->isLoaded())
            {    
                $landing_page_site->set('status','DELETE');
                $landing_page_site->save();
                $response = array("action"=>"DisableWpLandingPageSite","id" =>$landing_page_site->get('id'));
            }
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}
