<?php


class customers_restrictiveAccessAvatarAction  extends mfAction {
    
    
    function execute(mfWebRequest $request) {  
        if (!$this->getUser()->isAuthenticated())
            $this->forward404File();
        $response=$this->getResponse();        
        $user=$this->getUser()->getGuardUser(); // get current user     
        $file=$user->getDirectory()."/".$request->getRequestParameter('file');        
        if (!is_readable($file))
        {
            $response->setHttpHeader('HTTP/1.1 404 File not found');
            $response->setHttpHeader('Status','404');           
            return mfView::HEADER_ONLY;
        }              
        $response->setHeaderFile($file);
        $response->sendHttpHeaders();        
        readfile($file);
        die();     
        return mfView::NONE;
    }

}