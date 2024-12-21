<?php


class app_domoprime_iso_GenerateDocumentForContractAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();         
      $this->user=$this->getUser();     
      try
      {
        $contract=new CustomerContract($request->getGetParameter('Contract'));    
        if ($contract->isNotLoaded())
            throw new mfException(__('Contract is invalid.')); 
        if (!$contract->isOwner() && !$this->getUser()->hasCredential(array(array('superadmin','admin','iso_document_owner'))))
             $this->forwardTo401Action();    
        
    /*    $engine= new DomoprimeIsoDocumentEngine($contract);
        $engine->process();*/
        
        $document_engine=new DomoprimeAhDocumentEngine($contract,'ISO');            
        $document_engine->getEngine()->process();
        
        $this->getEventDispather()->notify(new mfEvent($document_engine->getEngine(), 'app_domoprime.iso.document.process.pdf')); 
        
        if ($document_engine->getEngine()->hasGenerator())
        {                                
            $response=$this->getResponse();   
            $response->setHttpHeader('Cache-Control: no-cache, must-revalidate');
            $response->setHttpHeader('Content-disposition: inline; filename="'.$document_engine->getEngine()->getFile()->getName().'"'); 
            $response->sendHttpHeaders();
            readfile($document_engine->getEngine()->getFile()->getFile());    
            die();
        }
        
        if ($contract->hasPolluter())
        {
            if ($request->getGetParameter('doc')=='true' && $this->getUser()->hasCredential(array(array('superadmin'))))
            {
                echo "Doc=".$document_engine->getEngine()->getName()." Polluter=".$contract->getPolluter()->get('name');
                return ;
            }    
            $polluter_document=new PartnerPolluterDocument(array('document'=>$document_engine->getEngine()->getDocument(),'polluter'=>$contract->getPolluter()));              
            if ($polluter_document->isNotLoaded())
             throw new mfException(__("Document is invalid."));
            if ($polluter_document->getModel()->isNotLoaded())
              throw new mfException(__("Model is invalid."));
            if ($polluter_document->getDocument()->isNotLoaded())
              throw new mfException(__("Base document is invalid."));
           // if (!$polluter_document->isAuthorized($contract)) 
           //     $this->forwardTo401Action();           
            if ($polluter_document->getModel()->getI18n()->hasFile())
           {
              if (!$polluter_document->getModel()->getI18n()->getFile()->isExist())
                  throw new mfException(__("Model [%s] for polluter [%s] doesn't exist.",array((string)$polluter_document->getModel()->getI18n(),$contract->getPolluter()->get('name'))));
              if (!mfModule::isModuleInstalled('system_resources') || !SystemResourceSettings::load()->hasResource('pdftk'))
                  throw new mfException(__('Resource PDFtk not available'));             
              $pdf=new DomoprimePartnerPolluterDocumentFromPdf($contract,$polluter_document);
              $pdf->save(); 
              ob_start();
              ob_end_clean();          
              $response=$this->getResponse();    
              $response->setHttpHeader('Cache-Control: no-cache, must-revalidate');
              $response->setHttpHeader('Content-disposition: inline; filename="'.$polluter_document->getDocument()->getNameWithExtension().'"');                    
              $response->sendHttpHeaders();
              readfile($pdf->getFilename()); 
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
            die();
        }                           
        if ($request->getGetParameter('doc')=='true' && $this->getUser()->hasCredential(array(array('superadmin'))))
        {
                echo "Doc=".$document_engine->getEngine()->getName();
            //   return;
        } 
        if ($document_engine->getEngine()->getDocument()->getModel()->isNotLoaded())
              throw new mfException(__("Model is invalid."));
         if ($document_engine->getEngine()->getDocument()->getModel()->getI18n()->hasFile())
          {            
            if (!mfModule::isModuleInstalled('system_resources') || !SystemResourceSettings::load()->hasResource('pdftk'))
                  throw new mfException(__('Resource PDFtk not available'));
            $pdf=new CustomerMeetingFormDocumentFromPDF($contract,$document_engine->getEngine()->getDocument());
            $pdf->save(); 
           if ($request->getGetParameter('debug')=='true' && $this->getUser()->hasCredential(array(array('superadmin'))))
            {                                  
                 $response=$this->getResponse();   
                 $response->setHttpHeader('Cache-Control: no-cache, must-revalidate');
                 $response->setHttpHeader('Content-disposition: inline; filename="'.$pdf->getXML()->getName().'"');                    
                 $response->sendHttpHeaders();
                 readfile($pdf->getXML()->getFile()); 
                 die();
            }    
             ob_start();
             ob_end_clean();          
             $response=$this->getResponse();    
             $response->setHttpHeader('Cache-Control: no-cache, must-revalidate');
             $response->setHttpHeader('Content-disposition: inline; filename="'.$document_engine->getEngine()->getDocument()->getNameWithExtension().'"');                   
             $response->sendHttpHeaders();
             readfile($pdf->getFilename()); 
          }    
          else
          {                  
            $pdf=new CustomerMeetingFormDocumentPDF($contract,$document_engine->getEngine()->getDocument());
            if ($request->getGetParameter('debug')=='true')
                $pdf->output();
            else
                $pdf->forceOutput();                       
          }      
          $this->getEventDispather()->notify(new mfEvent($pdf, 'meeting.form.document.generation.pdf')); 
      }
      catch (mfException $e)
      {
          echo $e->getMessage();
      }     
      die();
    }
}

