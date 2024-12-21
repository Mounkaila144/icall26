<?php


class app_domoprime_fileAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {            
      try 
      {            
          $contract=new CustomerContract($request->getRequestParameter('contract'));         
          if ($contract->isNotLoaded())
             $this->forward404File();
          $document=new CustomerMeetingFormDocument($request->getRequestParameter('document'));                           
          if ($document->isNotLoaded())
             throw new mfException(__("Document is invalid."));
          if ($document->getModel()->isNotLoaded())
             throw new mfException(__("Model is invalid."));                                 
          if ($document->isAuthorized($contract))
          {
             
          }    
          else
          {
             $this->forwardTo401Action();
          }                  
          if ($document->getModel()->getI18n()->hasFile())
          {                 
            if (!mfModule::isModuleInstalled('system_resources') || !SystemResourceSettings::load()->hasResource('pdftk'))
                  throw new mfException(__('Resource PDFtk not available'));
            $pdf=new CustomerMeetingFormDocumentFromPDF($contract,$document);
            $pdf->save();                      
            if ($request->getGetParameter('debug')=='true' && $this->getUser()->hasCredential(array(array('superadmin'))))
            {                                  
                 $response=$this->getResponse();  
                 $response->setHttpHeader('Cache-Control','no-cache, must-revalidate');
                 $response->setHttpHeader('Content-disposition','inline; filename='.$pdf->getXML()->getName());      
                 $response->sendFile($pdf->getXML()->getFile(),0);    
                 die();
            }                                       
             ob_start();
             ob_end_clean();          
             $response=$this->getResponse();          
             $response->setHttpHeader("Cache-Control"," no-cache, must-revalidate");         
             $response->setHttpHeader('Content-disposition','inline; filename='.$document->getNameWithExtension());               
             $response->sendFile($pdf->getFilename(),0);             
             die();
          }    
          else
          {              
            $pdf=new CustomerMeetingFormDocumentPDF($contract,$document);
            if ($request->getGetParameter('debug')=='true')
                $pdf->output();
            else
                $pdf->forceOutput();                        
          }                   
           $this->getEventDispather()->notify(new mfEvent($pdf, 'meeting.form.document.generation.pdf')); 
      } 
      catch (mfException $e) {
         echo $e->getMessage(); 
      } 
      die();
    }
}

