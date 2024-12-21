<?php


class server_services_ajaxPingServerAction extends mfAction{
    
    
    public function execute(\mfWebRequest $request) {
        
        $messages = mfMessages::getInstance(); 
        try
        {  
            $server=new SiteServicesServer($request->getPostParameter('Server'));            
            if ($server->isLoaded())
            {                                   
                $api=new iCall26ServerServiceApi($server);               
                $api->login($server->get('login_service'),$server->getDecryptedPassword());   
                $api->ping();                 
                if ($api->hasErrors())
                    throw new mfException(__("Service has some errors."));                
                $response=array('action'=>'Ping',                           
                            'info'=>$api->getResponse()->getItemByKey('ping')=='OK'?__('Server has an answer'):__("Server has no answer"),
                            'id'=>$server->get('id'));
            }
       }
        catch (mfException $e)
        {
            $messages->addError($e);
        }  
        return $messages->hasErrors()?array("errors"=>$messages->getDecodedErrors()):$response;
    }

}
