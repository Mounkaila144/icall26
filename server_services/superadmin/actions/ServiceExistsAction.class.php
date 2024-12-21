<?php


class server_services_ServiceExistsAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
                                     
            if (!$request->isMethod('POST')) 
                return array('status'=>'KO','error'=>__('No params found'));
            $site=new Site(array('site_host'=>$request->getPostParameter('host')));
            if($site->isLoaded())
            {               
                return array('status'=>'OK');
            }
            else
            {
                return  array('status'=>'KO');
            }        
    }

}
