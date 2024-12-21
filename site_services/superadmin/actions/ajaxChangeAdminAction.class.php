<?php

class site_services_ajaxChangeAdminAction extends mfAction{
    
    
    public function execute(\mfWebRequest $request) {
        $messages = mfMessages::getInstance(); 
        try
        {  
            $site_service=new SiteServicesSite($request->getPostParameter('host'));
            $value=$request->getPostParameter('value')=='YES'?"NO":"YES";
            $site_service->set('admin_available', $value);
            $site_service->save();
            
            $api=new iCall26SiteServiceApi($site_service->getServer()); 
            $api->login($site_service->getServer()->get('login_service'),$site_service->getServer()->getDecryptedPassword()); 
            $api->changeAdmin($site_service->get('host'),$request->getPostParameter('value'));
          
            
            $response=array('action'=>'ChangeAdmin',
                            'state'=>$site_service->get('admin_available'),
                            'id'=>$site_service->get('id'));
       }
        catch (mfException $e)
        {
            $messages->addError($e);
        }  
        return $messages->hasErrors()?array("errors"=>$messages->getDecodedErrors()):$response; 
    }

}
