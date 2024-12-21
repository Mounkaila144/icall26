<?php


class marketing_leads_restrictiveAccessLogFileAction  extends mfAction {
    
    
    function execute(mfWebRequest $request) {
        $response=$this->getResponse();
        $user=$this->getUser()->getGuardUser(); // get current user 
        $import_file = new MarketingLeadsWpFormsLeadsImportFile($request->getRequestParameter('import_file'));        
        if ($import_file->isNotLoaded())
        {
            echo "import file not loaded";
            $response->setHttpHeader('HTTP/1.1 404 File not found');
            $response->setHttpHeader('Status','404');           
            return mfView::HEADER_ONLY;
        }   
        $file=$import_file->getLogFile()->getPath()."/".$import_file->get('file_log');        
        
        if (!$import_file->getLogFile()->isExist())
        {
            echo "unreadable";
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