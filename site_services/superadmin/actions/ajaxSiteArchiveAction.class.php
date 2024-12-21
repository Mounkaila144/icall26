<?php


class site_services_ajaxSiteArchiveAction extends mfAction{
   
    public function execute(\mfWebRequest $request) {
        $messages = mfMessages::getInstance(); 
        try
        {  
            $site_service=new SiteServicesSite($request->getPostParameter('host'));
            $api=new iCall26SiteServiceApi($site_service->getServer()); 
            $api->login($site_service->getServer()->get('login_service'),$site_service->getServer()->get('password'));
            $api->siteArchive($site_service->get('host'));
            $response=$api->getResponse();
        } 
        catch (mfException $e)
        {
            $messages->addError($e);
        }
        return $messages->hasErrors()?array("errors"=>$messages->getDecodedErrors()):$response;
    }

  

}
