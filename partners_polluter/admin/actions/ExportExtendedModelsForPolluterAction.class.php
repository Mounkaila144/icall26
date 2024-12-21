<?php


require_once __DIR__."/../locales/Forms/ExportMultipleExtendedModelForPolluterForm.class.php";
require_once __DIR__."/../locales/Exports/PartnerPolluterExtendedModelArchive.class.php";

class partners_polluter_ExportExtendedModelsForPolluterAction extends mfAction {
        
    
    function execute(mfWebRequest $request) {            
      try 
      {  
         
            $form=new ExportMultipleExtendedModelForPolluterForm();
            $form->bind($request->getGetParameters());
            if (!$form->isValid())
                throw new mfException(__('Format is invalid'));
            // var_dump($form->getSelection());
            $archive= new PartnerPolluterExtendedModelArchive($form->getPolluter(),$form->getSelection());
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

