<?php


class app_domoprime_ExportPolluterPreMeetingDocumentPdfAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {          
          $contract=new CustomerContract($request->getGetParameter('Contract'));         
          if ($contract->isNotLoaded())
             throw new mfException(__("Contract is invalid."));
          if (!$contract->hasPolluter())
              throw new mfException(__("No polluter."));                      
          $polluter_premeeting_model=new DomoprimePolluterPreMeeting($contract->getPolluter());
          $model=$polluter_premeeting_model->getModel();                 
          if ($model->isNotLoaded())
              throw new mfException(__("Polluter Pre Meeting Model is invalid."));                          
          $this->getEventDispather()->notify(new mfEvent($contract, 'app_domoprime.premeeting.process.pdf')); 
          if ($model->getI18n()->hasFile())
          {
             if (!mfModule::isModuleInstalled('system_resources') || !SystemResourceSettings::load()->hasResource('pdftk'))
                 throw new mfException(__('Resource PDFtk not available'));             
             $base_pdf=new DomoprimePreMeetingDocumentPdf($contract,$model);
             $base_pdf->save(); 
                         
             $pdf= new DomoprimePreMeetingDocumentGeneratorPdf($base_pdf, $polluter_premeeting_model);
             $pdf->process();  
             
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

