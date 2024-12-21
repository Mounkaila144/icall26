<?php


require_once __DIR__."/../locales/Forms/ExportMultipleModelForPolluterForm.class.php";
require_once __DIR__."/../locales/Exports/PartnerPolluterModelArchive.class.php";

class partners_polluter_ExportModelsForPolluterAction extends mfAction {
        
    
    function execute(mfWebRequest $request) {            
      try 
      {  
         
            $form=new ExportMultipleModelForPolluterForm();
            $form->bind($request->getGetParameters());
            if (!$form->isValid())
                throw new mfException(__('Format is invalid'));
            // var_dump($form->getSelection());
            $archive= new PartnerPolluterModelArchive($form->getPolluter(),$form->getSelection());
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

