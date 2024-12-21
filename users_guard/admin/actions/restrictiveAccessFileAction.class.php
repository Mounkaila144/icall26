<?php


class users_guard_restrictiveAccessFileAction  extends mfAction {
    
    
    function execute(mfWebRequest $request) {  
        $current_user=$this->getUser()->getGuardUser(); // get current user 
        $user=new User($request->getRequestParameter('user'));
        $response=$this->getResponse();
        if ($user->get('id')!=$current_user->get('id')&&!$this->getUser()->hasCredential(array(array('admin'))))
        {    
           $response->setHttpHeader('HTTP/1.1 401 Access to file is not authorized');
           $response->setHttpHeader('Status','401');
           return mfView::HEADER_ONLY;
        }           
        $file=mfConfig::get('mf_site_dir')."/admin/".$request->getRequestParameter('path');
        if ($file==""||!is_readable($file))
        {
            $response->setHttpHeader('HTTP/1.1 404 File not found');
            $response->setHttpHeader('Status','404');
           
            return mfView::HEADER_ONLY;
        }   
        $response->setHttpHeader('Cache-Control: no-cache, must-revalidate');
        $response->setHeaderFile($file);
        $response->sendHttpHeaders();
        readfile($file);
        die();
        return mfView::NONE;
    }

}