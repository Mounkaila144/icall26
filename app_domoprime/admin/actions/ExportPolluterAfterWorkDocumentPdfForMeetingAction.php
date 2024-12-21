<?php


class app_domoprime_ExportPolluterAfterWorkDocumentPdfForMeetingAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {          
          $meeting=new CustomerMeeting($request->getGetParameter('Meeting'));         
          if ($meeting->isNotLoaded())
             throw new mfException(__("Meeting is invalid."));
          if (!$meeting->hasPolluter())
              throw new mfException(__("No polluter."));                      
          $polluter_billing_model=new DomoprimePolluterAfterWork($meeting->getPolluter());
          $model=$polluter_billing_model->getModel();                 
          if ($model->isNotLoaded())
              throw new mfException(__("Polluter Pre Meeting Model is invalid."));                          
          $this->getEventDispather()->notify(new mfEvent($meeting, 'app_domoprime.premeeting.meeting.process.pdf')); 
          if ($model->getI18n()->hasFile())
          {
             if (!mfModule::isModuleInstalled('system_resources') || !SystemResourceSettings::load()->hasResource('pdftk'))
                 throw new mfException(__('Resource PDFtk not available'));             
             $pdf=new DomoprimeAfterWorkDocumentMeetingPdf($meeting,$model);
             $pdf->save(); 
             
             ob_start();
             ob_end_clean();          
             $response=$this->getResponse();     
             $response->setHttpHeader('Cache-Control: no-cache, must-revalidate');
             $response->setHttpHeader("Content-disposition","inline; filename=".$model->getNameWithExtension());      
             $response->sendFile($pdf->getFilename());                             
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

