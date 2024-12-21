<?php

 
class marketing_leads_ajaxRecoveryWpLandingPageSiteAction extends mfAction {
    
    function execute(mfWebRequest $request) { 
        
        $messages = mfMessages::getInstance();     
        try
        {            
            $this->site=new MarketingLeadsWpLandingPageSite($request->getPostParameter('WpLandingPageSite')); 
            if($this->site->isNotLoaded())
            {
                $messages->addError(__('Site not loaded'));
                return array("error"=>__('Site not loaded'));
            } 
            
            $this->site->getLeadsFromWpTable();
            $response = array("info"=>__("Recovery success!"));
        }
        catch (mfException $e)
        {
            $messages->addError(__("Error produced while recovering data"));
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
   }

}

