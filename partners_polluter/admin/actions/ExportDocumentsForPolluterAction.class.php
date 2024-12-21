<?php


require_once __DIR__."/../locales/Exports/PartnerPolluterDocumentArchive.class.php";

class partners_polluter_ExportDocumentsForPolluterAction extends mfAction {
        
    
    function execute(mfWebRequest $request) {            
      try 
      {  
           $polluter=new PartnerPolluterCompany($request->getGetParameter('polluter'));
           if ($polluter->isNotLoaded())
               throw new mfException(__("Polluter doesn't exist"));                      
            $archive= new PartnerPolluterDocumentArchive($polluter);
            $archive->process();

            $response=$this->getResponse();                                
            $response->setHttpHeader('Cache-Control: no-cache, must-revalidate');
            $response->setHeaderFile($archive->getFilename(),true);            
            $response->sendHttpHeaders();     
            ob_start();
            ob_end_clean();  
            ob_end_flush();
            readfile($archive->getFilename());  
             
      } 
      catch (mfException $e) {
         echo $e->getMessage();
      } 
      die();
    }
}

