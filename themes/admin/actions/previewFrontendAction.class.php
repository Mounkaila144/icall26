<?php


class themes_previewFrontendAction  extends mfAction {
    
    
    function execute(mfWebRequest $request) {  
       
        $theme=new ThemeCore($request->getRequestParameter('theme'),'frontend');       
        $response=$this->getResponse(); 
        $file=$theme->getDirectory()."/config/".$request->getRequestParameter('preview');
       // var_dump($file);
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