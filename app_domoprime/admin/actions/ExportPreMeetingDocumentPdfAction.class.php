<?php


class app_domoprime_ExportPreMeetingDocumentPdfAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {          
          $contract=new CustomerContract($request->getGetParameter('Contract'));         
          if ($contract->isNotLoaded())
             throw new mfException(__("Contract is invalid."));
          $settings= DomoprimeSettings::load();
          if ($settings->getModelForPreMeetingDocument()->isNotLoaded())
              throw new mfException(__("Model is invalid."));
          $this->getEventDispather()->notify(new mfEvent($contract, 'app_domoprime.premeeting.process.pdf')); 
          if ($settings->getModelForPreMeetingDocument()->getI18n()->hasFile())
          {
             if (!mfModule::isModuleInstalled('system_resources') || !SystemResourceSettings::load()->hasResource('pdftk'))
                 throw new mfException(__('Resource PDFtk not available'));             
             $pdf=new DomoprimePreMeetingDocumentPdf($contract,$settings->getModelForPreMeetingDocument());
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

