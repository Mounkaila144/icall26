<?php


class server_services_ServiceDatabaseExistsAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
                                     
            if (!$request->isMethod('POST')) 
                return array('status'=>'KO','error'=>__('No params found'));
            $site=new Site(array('site_db_name'=>$request->getPostParameter('name')));
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
