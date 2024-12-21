<?php


class dashboardActions extends mfActions {
    
     
       
    function executeError404(mfWebRequest $request)
    {       
        $this->getResponse()->setHttpHeader('HTTP/1.1 404 Page not found');
        $this->getResponse()->setHttpHeader('Status','404');
    }
    
    function executeError401()
    {
        $this->getResponse()->setHttpHeader('HTTP/1.1 401 Unauthorized Page');
        $this->getResponse()->setHttpHeader('Status','401');
    }
    
    function executeIndex(mfWebRequest $request)
    {    
        $messages = mfMessages::getInstance();  
        $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
    
  /*  function executeAjaxIndex()
    {
    }*/
    
    function executeLogfile(mfWebRequest $request )
    {
        $file=new logFile($request->getRequestParameter('file'));  
        if ($file->isExist())
        {    
            $this->response->setHttpHeader('Content-Type', $file->getMime());
            $this->response->setHttpHeader('Content-Length', $file->getSize());
            $this->response->sendHttpHeaders();
            readfile($file->getFile());
            flush();    
        }
        else
            $this->forward404File();
        return mfView::NONE;
    }
}


