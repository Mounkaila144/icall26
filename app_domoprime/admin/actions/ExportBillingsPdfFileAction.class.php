<?php


class app_domoprime_ExportBillingsPdfFileAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {          
           //var_dump(DomoprimeBillingsPDF::getDirectory());
          $file=DomoprimeBillingsPDF::getFile($request->getRequestParameter('file'));
          if (!$file->isExist())
              throw new mfException(__("File doesn't exist."));   
                   
          ob_start();
          ob_end_clean();
          $response=$this->getResponse();
          $response->setHttpHeader('Cache-Control: no-cache, must-revalidate');
          $response->setHeaderFile($file->getFile());
          $response->sendHttpHeaders();
          readfile($file->getFile()); 
          die();
      } 
      catch (mfException $e) {
          $messages->addError($e);
          echo $e->getMessage();
      } 
    //  var_dump($messages->getDecodedErrors());
      die();
    }
}

