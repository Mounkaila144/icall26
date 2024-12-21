<?php


class marketing_leads_ajaxEnabledStatusWpLandingPageSiteAction extends mfAction {
    
    function execute(mfWebRequest $request) {     
        $messages = mfMessages::getInstance();   
        try 
        {         
            $validator = new mfValidatorInteger();
            $landing_page_site = new MarketingLeadsWpLandingPageSite($validator->isValid($request->getPostParameter('WpLandingPageSite')));
            if ($landing_page_site->isLoaded())
            {    
                $landing_page_site->set('status','ACTIVE');
                $landing_page_site->save();
                $response = array("action"=>"EnableWpLandingPageSite","id" =>$landing_page_site->get('id'));
            }
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}
