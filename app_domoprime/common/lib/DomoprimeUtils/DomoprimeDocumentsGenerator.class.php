<?php


class DomoprimeDocumentsGenerator {
    
    protected $contract=null,$user=null,$site=null,$quotation=null,$engine=null,$billing=null,$settings=null,$files=null;
            
    function __construct(CustomerContract $contract,$user) {
        $this->contract=$contract;
        $this->site=$contract->getSite();
        $this->user=$user;   
        $this->files=new mfArray();
        $this->settings=new DomoprimeSettings(null,$this->getSite());         
    }
  
    function getContract()
    {
        return $this->contract;
    }
    
    function getBilling()
    {
        return $this->billing;
    }
    
    function getSettings()
    {
        return $this->settings;
    }
    
    
    function getQuotation()
    {
        return $this->quotation;
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function getSite()
    {
        return $this->site;
    }
    
    function getEngine()
    {
        return $this->engine;
    }
    
    function processEngine()
    {
           $this->engine=new DomoprimeEngine($this->getContract());
           $this->engine->process();
           $report=new DomoprimeCalculation($this->engine,$this->getSite());
           $report->process($this->getUser()->getGuardUser());   
           return $this;
    }
    
    function processQuotation()
    {
        
        // Quotation
          $this->quotation=new DomoprimeQuotation($this->getContract());         
          if ($this->quotation->isNotLoaded())
               throw new mfException(__("Quotation doesn't exist."));
          $model=null;
          if ($this->quotation->hasContract() && $this->quotation->getContract()->hasPolluter())
          {              
              $polluter_quotation_model=new DomoprimePolluterQuotation($this->quotation->getContract()->getPolluter());
              $model=$polluter_quotation_model->getModel();            
          }                    
          elseif ($this->quotation->hasMeeting() && $this->quotation->getMeeting()->hasPolluter())
          {
              $polluter_quotation_model=new DomoprimePolluterQuotation($this->quotation->getMeeting()->getPolluter());
              $model=$polluter_quotation_model->getModel();             
          }
          if ($model==null || $model->isNotLoaded())
          {    
            $model=DomoprimeSettings::load()->getModelForQuotation();     
          }          
          if ($model->isNotLoaded())
              throw new mfException( __("Quotation model is invalid."));
          $pdf=new DomoprimeQuotationPDF($model,$this->quotation);
          $pdf->save();
          $this->files[]=$pdf->getFile()->getFile();
       /*   if ($this->getSettings()->get('quotation_archivage')=='YES')
          {             
              $document=new CustomerDocument();
              $document->createDocument($this->getContract()->getCustomer(),__("Quotation"),__("Quotation"),$pdf->getFile());                              
          }*/
          return $this;
    }
    
    function processBilling()
    {       
          if (!$this->getContract()->hasOpcAt())
              throw new mfException(__("Opc date doesn't exist."));           
          $this->billing=new DomoprimeBilling($this->getQuotation(),$this->getSite());  
          if ($this->billing->isNotLoaded())
          {
            $this->billing->createFromQuotation($this->getContract(),$this->getQuotation(),$this->getUser());
            $this->getContract()->setClosedAtFromOpcAt();
          }          
          $model=null;
          if ($this->billing->hasContract() && $this->billing->getContract()->hasPolluter())
          {              
              $polluter_billing_model=new DomoprimePolluterBilling($this->billing->getContract()->getPolluter());
              $model=$polluter_billing_model->getModel();            
          }                    
          elseif ($this->billing->hasMeeting() && $this->billing->getMeeting()->hasPolluter())
          {
              $polluter_billing_model=new DomoprimePolluterBilling($this->billing->getMeeting()->getPolluter());
              $model=$polluter_billing_model->getModel();             
          }
          if ($model==null || $model->isNotLoaded())
          {    
            $model=DomoprimeSettings::load($this->getSite())->getModelForBilling();     
          }           
          if ($model->isNotLoaded())
              throw new mfException( __("Billing model is invalid."));
          $pdf=new DomoprimeBillingPDF($model,$this->getBilling());
          $pdf->save();    
          $this->files[]=$pdf->getFile()->getFile();
       /*  if ($this->getSettings()->get('billing_archivage')=='YES')
          {             
              $document=new CustomerDocument();
              $document->createDocument($this->getContract()->getCustomer(),__("Billing"),__("Billing"),$pdf->getFile());                              
          }*/
    }
    
    function processDocumentsForPolluter()
    {
        if (!mfModule::isModuleInstalled('system_resources',$this->getSite()) || !SystemResourceSettings::load($this->getSite())->hasResource('pdftk'))
             throw new mfException(__('Resource PDFtk not available'));         
   //     $documents=PartnerPolluterDocument::getDocumentsForContract($this->getContract(),$this->getUser());                    
        
        $documents=DomoprimeCustomerMeetingFormDocument::getDocumentsPolluterForContract($this->getContract());
        
        if ($documents->isEmpty())
        {                 
            return $this->processDocuments();
        }    
        foreach ($documents as $document)
        {    
            if ($document->getModel()->getI18n()->hasFile())
            {                 
                 $pdf=new DomoprimePartnerPolluterDocumentFromPdf($this->getContract(),$document);
                 $pdf->save(); 
                 $this->files[]=$pdf->getFile()->getFile();
            }   
            else
            {
                echo "Document for polluter not supported"; die();
            }    
        }
        return $this;
    }
    
    function processDocuments()
    {
        if (!mfModule::isModuleInstalled('system_resources',$this->getSite()) || !SystemResourceSettings::load($this->getSite())->hasResource('pdftk'))
             throw new mfException(__('Resource PDFtk not available'));
       // $documents=CustomerMeetingFormDocument::getDocumentsForContract($this->getContract(),$this->getUser());         
        $documents=DomoprimeCustomerMeetingFormDocument::getDocumentsForContract($this->getContract());
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
        /*  if ($this->getSettings()->get('ah_archivage')=='YES')
          {                       
            $archive=new CustomerDocument();
            $archive->createDocument($this->getContract()->getCustomer(),$pdf->getDocument()->get('name'),$pdf->getDocument()->getName(),$pdf->getFile());                              
          }*/
        }                                    
        return $this;
    }
    
    function processAhDocuments()
    {
        if ($this->getEngine()->hasPolluter())
            {                   
                $this->processDocumentsForPolluter();
            }    
            else    
            {    
                $this->processDocuments();
            }
            return $this;
    }
    
    function process()
    {
        try
        {
            $this->processEngine();
            
            
            $this->processAhDocuments();
            $this->processQuotation();
            $this->processBilling();                                         
        } 
        catch (mfException $ex) {
            throw $ex;
        }
        return $this;
    }
    
    function getOutputPath()
    {
        return mfConfig::get('mf_site_app_cache_dir')."/data/contracts/documents/".$this->getContract()->get('id');
    }
    
    function getOutputFile()
    {
        return "documents_".md5(session_id()).".pdf";
    }
    
    function getOutputFilename()
    {
        return $this->getOutputPath()."/".$this->getOutputFile();
    }
    
    
    function processPreMeeting()
    {
         if ($this->getSettings()->get('premeeting_archivage')!='YES')
            return $this;
         if ($this->getSettings()->getModelForPreMeetingDocument()->isNotLoaded())
              throw new mfException(__("PreMeeting Model is invalid."));
         if (!$this->getSettings()->getModelForPreMeetingDocument()->getI18n()->hasFile())
            throw new mfException(__("PreMeeting Model not supported."));
         if (!mfModule::isModuleInstalled('system_resources') || !SystemResourceSettings::load()->hasResource('pdftk'))
                 throw new mfException(__('Resource PDFtk not available'));             
         $pdf=new DomoprimePreMeetingDocumentPdf($this->getContract(),$this->getSettings()->getModelForPreMeetingDocument());
         $pdf->save();   
         $this->files[]=$pdf->getFilename();
         return $this;
    }
    
    
    
    
    function merge()
    {
        if (!mfModule::isModuleInstalled('system_resources',$this->getSite()))
          throw new mfException(__("Resource module is missing."));
        if (!SystemResourceSettings::load($this->getSite())->hasResource('ghostsript'))
          throw new mfException(__("Resource 'ghostscript' is missing."));
      //echo "<pre>"; var_dump($this->files);       die(__METHOD__);
        
        mfFileSystem::mkdirs($this->getOutputPath());
        $merger=new SystemGhostScript();
        $merger->setOutput($this->getOutputFilename());
        $merger->setFiles($this->files);
        $merger->execute();
        if ($merger->hasErrors())
            throw new mfException(__("Merge has some errors."));      
        if ($this->getSettings()->get('multi_documents_archivage')=='YES')
        {                       
           $archive=new CustomerDocument();
           $archive->createDocument($this->getContract()->getCustomer(),__('AH/Quotation/Billing'),__('AH_Quotation_Billing'),$merger->getOutputFile());                              
         }         
    }
}
