<?php

class server_services_ajaxPingAction extends mfAction{
    
    
    public function execute(\mfWebRequest $request) {
        $messages = mfMessages::getInstance(); 
        try
        {               
            $api=new iCall26ServerServicesApi();            
            $api->ping();  
            if ($api->hasErrors())
                throw new mfException(__('No answer from host'));
            $response=array('action'=>'Ping',
                            'info'=>__('Master server is valid'),
                            );
       }
        catch (mfException $e)
        {
            $messages->addError($e);
        }  
        return $messages->hasErrors()?array("errors"=>$messages->getDecodedErrors()):$response; 
    }

}
