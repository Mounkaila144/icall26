<?php


class server_services_ajaxRefreshServerAction extends mfAction{
   
    public function execute(\mfWebRequest $request){
        
        $messages = mfMessages::getInstance(); 
        try
        {        
            $server=new SiteServicesServer($request->getPostParameter('Server'));            
            if ($server->isNotLoaded())
                throw new mfException(__('Server is invalid.'));
             $server->refresh();
             
            $response=array('action'=>'Refresh',                           
                            'info'=>__('Server has been updated.')
                             );
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }  
        return $messages->hasErrors()?array("errors"=>$messages->getDecodedErrors()):$response;
    }

}
