<?php


class server_services_ajaxPingServerIcall26Action extends mfAction{
    
    
    public function execute(\mfWebRequest $request) {
        
        $messages = mfMessages::getInstance(); 
        try
        {  
            $server_icall26=new ServerICall26($request->getPostParameter('Server'));            
            if ($server_icall26->isLoaded())
            {    
                $api = $server_icall26->ping(); 
                $response=array('action'=>'Ping',                           
                            'info'=>$api->getResponse()->getItemByKey('ping')=='OK'?__('Server has an answer'):__("Server has no answer"),
                            'id'=>$server_icall26->get('id'));
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }  
        return $messages->hasErrors()?array("errors"=>$messages->getDecodedErrors()):$response;
    }

}
