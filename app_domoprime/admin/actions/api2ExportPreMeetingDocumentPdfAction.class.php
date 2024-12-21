<?php

// www.ecosol16.net/admin/api/v2/applications/iso/admin/ExportPreMeetingDocumentPdf
// 32a30.icall26.net/admin/api/v2/applications/iso/admin/ExportPreMeetingDocumentPdf

class app_domoprime_api2ExportPreMeetingDocumentPdfAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*')
                            ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                            ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
      $messages = mfMessages::getInstance(); 
      if (!$this->getUser()->hasCredential([['superadmin','api_v2_app_domoprime_pre_meeting_export_pdf']]))
            $this->forwardTo401Action();
      try 
      {                   
          $contract=new CustomerContract($request->getGetAndPostParameter('contract'));         
          if ($contract->isNotLoaded())
              $this->forward('default','400');
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
        //   echo $e->getMessage();
          $this->forward('default','404');
      } 
    
      die();
    }
}

