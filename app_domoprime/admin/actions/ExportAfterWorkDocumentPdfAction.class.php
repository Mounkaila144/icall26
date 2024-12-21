<?php

//www.ecosol16.net/admin//applications/domoprime/admin/ExportAfterWorkDocumentPdf

class app_domoprime_ExportAfterWorkDocumentPdfAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {       
          $contract=new CustomerContract($request->getGetParameter('Contract'));         
          if ($contract->isNotLoaded())
             throw new mfException(__("Contract is invalid."));
          $settings= DomoprimeSettings::load();
          if ($settings->getModelForAfterWorkDocument()->isNotLoaded())
              throw new mfException(__("Model is invalid."));
          $this->getEventDispather()->notify(new mfEvent($contract, 'app_domoprime.afterwork.process.pdf')); 
          if ($settings->getModelForAfterWorkDocument()->getI18n()->hasFile())
          {
             if (!mfModule::isModuleInstalled('system_resources') || !SystemResourceSettings::load()->hasResource('pdftk'))
                 throw new mfException(__('Resource PDFtk not available'));             
             $pdf=new DomoprimeAfterWorkDocumentPdf($contract,$settings->getModelForAfterWorkDocument());
             $pdf->save();                                                          
             ob_start();
             ob_end_clean();          
             $response=$this->getResponse();    
             $response->setHttpHeader('Cache-Control: no-cache, must-revalidate');            
               $response->setHeaderFile($pdf->getFilename());
               $response->sendHttpHeaders();
               readfile($pdf->getFilename());
          }    
          else
          {
              echo "Not supported"; die();                          
          }                   
      } 
      catch (mfException $e) {
          echo $e->getMessage();
      } 
    
      die();
    }
}

