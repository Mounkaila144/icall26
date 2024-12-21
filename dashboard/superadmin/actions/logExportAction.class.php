<?php

class dashboard_logExportAction extends mfAction {
    
    function execute(mfWebRequest $request)
    {
       if (!$request->getMethod('get'))
          return mfView::NONE;
       $logValidator=new mfValidatorLogFile();
       $logValidator->setMessage('file', __("file [{value}] doesn't exist"));
       $logValidator->setMessage('invalid', __("the file [{value}] is invalid"));
       try
       {
          $file=$logValidator->isValid($request->getGetParameter('name'));
          $this->response->setHttpHeader('Content-Type', mfFileMime::getType('log'));
          $this->response->setHttpHeader('Content-Length', $file->getSize());
          $this->response->setHttpHeader('Content-disposition','attachment;'.' Filename="'.$file->getName().'"');
          $this->response->sendHttpHeaders();
          $file->readfile();
          flush(); 
          die();
       }
       catch (mfValidatorError $e)
       {
             echo $e->getMessage();
       }
       return mfView::NONE;
    }
	
}

