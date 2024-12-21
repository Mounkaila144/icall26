<?php


class DomoprimeIsoDocumentsGenerator extends DomoprimeDocumentsGenerator {
    
    protected $request=null;
            
    function processEngine()
    {
        //   $this->engine=new DomoprimeIsoEngine($this->getContract());
        //   $this->engine->process();
           $this->engine=DomoprimeCumacEngine::getInstance()->getEngine($this->getContract());
           $this->engine->process();  
           
           $report=new DomoprimeCalculation($this->engine,$this->getSite());
           $report->process($this->getUser()->getGuardUser());  
           return $this;
    }
        
    
    function processDocumentsForPolluter()
    {
        $engine= new DomoprimeIsoDocumentEngine($this->getContract());
        $engine->process();
        if ($this->getContract()->hasPolluter())
        {               
            $polluter_document=new PartnerPolluterDocument(array('document'=>$engine->getDocument(),'polluter'=>$this->getContract()->getPolluter()));              
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
                  throw new mfException(__("Model [%s] for polluter [%s] doesn't exist.",array((string)$polluter_document->getModel()->getI18n(),$this->getCOntract()->getPolluter()->get('name'))));
              if (!mfModule::isModuleInstalled('system_resources') || !SystemResourceSettings::load()->hasResource('pdftk'))
                  throw new mfException(__('Resource PDFtk not available'));             
              $pdf=new DomoprimePartnerPolluterDocumentFromPdf($this->getContract(),$polluter_document);
              $pdf->save();      
              $this->files[]=$pdf->getFile()->getFile();      
           }    
           else
           {
               throw new mfException(__("Document model Not supported."));                                 
           }                            
        }         
        return $this;
    }
    
  /*  function processDocuments()
    {
       /* if (!mfModule::isModuleInstalled('system_resources',$this->getSite()) || !SystemResourceSettings::load($this->getSite())->hasResource('pdftk'))
             throw new mfException(__('Resource PDFtk not available'));
        $documents=CustomerMeetingFormDocument::getDocumentsForContract($this->getContract(),$this->getUser());         
        foreach ($documents as $document)
        {
          if ($document->getModel()->getI18n()->hasFile())
          {            
              $pdf=new CustomerMeetingFormDocumentFromPDF($this->getContract(),$document);
              $pdf->save();                           
          }    
          else
          {
            $pdf=new CustomerMeetingFormDocumentPDF($this->getContract(),$document);
            $pdf->save();
          }
          $this->files[]=$pdf->getFile()->getFile();
        
        }   
        return $this;
    }  */
    
    
    
   
}
