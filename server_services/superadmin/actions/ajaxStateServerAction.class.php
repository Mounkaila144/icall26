<?php


class server_services_ajaxStateServerAction extends mfAction{
    
    
    public function execute(\mfWebRequest $request) {
        
        $messages = mfMessages::getInstance(); 
        try
        {  
            
            $server=new SiteServicesServer($request->getPostParameter('Server'));            
            if ($server->isLoaded())
            {            
                var_dump(77);
                $api=new iCall26ServerServiceApi($server);               
                $api->login($server->get('login_service'),$server->getDecryptedPassword());   
                //$api->getState();    
                 
                if ($api->hasErrors())
                    throw new mfException(__("Service has some errors."));                
                $response=array('action'=>'state',                           
                            'info'=>$api->getResponse()->getItemByKey('status')=='OK'?__('Server has an answer'):__("Server has no answer"),
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
