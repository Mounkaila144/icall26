<?php


class site_services_ajaxChangeFrontendAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
        
        $messages = mfMessages::getInstance(); 
        try
        {  
            $site_service=new SiteServicesSite($request->getPostParameter('host'));
            $value=$request->getPostParameter('value')=='YES'?"NO":"YES";
            $site_service->set('frontend_available', $value);
            $site_service->save();
            $api=new iCall26SiteServiceApi($site_service->getServer()); 
            $api->login($site_service->getServer()->get('login_service'),$site_service->getServer()->getDecryptedPassword()); 
            $api->changeFrontend($site_service->get('host'),$request->getPostParameter('value'));        
              $response=array('action'=>'ChangeFrontend',
                            'state'=>$site_service->get('frontend_available'),
                            'id'=>$site_service->get('id'));
       }
        catch (mfException $e)
        {
            $messages->addError($e);
        }  
        return $messages->hasErrors()?array("errors"=>$messages->getDecodedErrors()):$response;
    }

}
