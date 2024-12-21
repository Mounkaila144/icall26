<?php


class app_domoprime_documentPolluterWithClassForContractAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {            
      try 
      {   
          $contract=new CustomerContract($request->getRequestParameter('contract'));         
          if ($contract->isNotLoaded())
             $this->forward404File();                    
                    
          $polluter_document=DomoprimeCustomerMeetingFormDocument::getDocumentPolluterForContract($contract);
         
          if ($polluter_document->isNotLoaded())
             throw new mfException(__("Document is invalid."));
          if ($polluter_document->getModel()->isNotLoaded())
              throw new mfException(__("Model is invalid."));
          if ($polluter_document->getDocument()->isNotLoaded())
              throw new mfException(__("Base document is invalid."));
        //   if (!$polluter_document->isAuthorized($contract)) 
        //      $this->forwardTo401Action();           
           if ($polluter_document->getModel()->getI18n()->hasFile())
          {
             if (!mfModule::isModuleInstalled('system_resources') || !SystemResourceSettings::load()->hasResource('pdftk'))
                 throw new mfException(__('Resource PDFtk not available'));             
             $pdf=new DomoprimePartnerPolluterDocumentFromPdf($contract,$polluter_document);
             $pdf->save(); 
             ob_start();
             ob_end_clean();          
             $response=$this->getResponse();                     
             $response->setHttpHeader("Content-disposition","inline; filename=".$polluter_document->getDocument()->getNameWithExtension());      
             $response->sendFile($pdf->getFilename());                             
          }    
          else
          {
              echo "Not supported"; die();
          /*  $pdf=new CustomerMeetingFormDocumentPDF($contract,$document);
            if ($request->getGetParameter('debug')=='true')
                $pdf->output();
            else
                $pdf->forceOutput();   */                     
          }              
          $this->getEventDispather()->notify(new mfEvent($pdf, 'meeting.form.document.generation.pdf')); 
      } 
      catch (mfException $e) {
         echo $e->getMessage(); 
      } 
      die();
    }
}

