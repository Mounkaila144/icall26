<?php


class DomoprimeIsoDocumentsGenerator3 extends DomoprimeIsoDocumentsGenerator2 {
    
    function processSignedQuotation()
    {        
          $quotation = new DomoprimeQuotation($this->getContract(),$this->getSite());
          if ($quotation->isNotLoaded())
              throw new mfException(__("Quotation doesn't exist."));
          if (!$quotation->isSigned())
              throw new mfException(__("Quotation is not signed."));
          $signed=new DomoprimeYouSignEvidenceQuotation($quotation,$this->getSite());
          if ($signed->isNotLoaded())
              throw new mfException(__("Signed Quotation doesn't exist."));           
          if (!$signed->getSignature()->getSignedFile()->isExist())
              $signed->getSignature()->downloadFileWithSignature();
          if (!$signed->getSignature()->getSignedFile()->isExist())
              throw new mfException(__("Signed Quotation file doesn't exist."));
          $this->files[]=$signed->getSignature()->getSignedFile()->getFile();
          return $this;
    }
    
    function processSignedQuotationProof()
    {        
          $this->quotation = new DomoprimeQuotation($this->getContract(),$this->getSite());
          if ($this->quotation->isNotLoaded())
              throw new mfException(__("Quotation doesn't exist."));
          if (!$this->quotation->isSigned())
              throw new mfException(__("Quotation is not signed."));
          $signed=new DomoprimeYouSignEvidenceQuotation($this->quotation,$this->getSite());
           if ($signed->isNotLoaded())
              throw new mfException(__("Signed Quotation doesn't exist."));
          if (!$signed->getSignature()->getProofFile()->isExist())
              $signed->getSignature()->downloadProof();
          if (!$signed->getSignature()->getProofFile()->isExist())
              throw new mfException(__("Proof Quotation file doesn't exist."));   
          $signed->getSignature()->getProofFile()->generatePdf();
          $this->files[]=$signed->getSignature()->getProofFile()->getPdf()->getFile();
          return $this;
    }
    
    function processSignedAhDocument()
    {
        $signed =new DomoprimeYouSignEvidenceMeetingDocumentForm($this->getContract(),$this->getSite());
        if ($signed->isNotLoaded())
            throw new mfException(__("Document doesn't exist."));
        if (!$signed->isSigned())
            throw new mfException(__("Document is not signed."));
        if (!$signed->getSignature()->getSignedFile()->isExist())
              $signed->getSignature()->downloadFileWithSignature();
        if (!$signed->getSignature()->getSignedFile()->isExist())
              throw new mfException(__("Signed document file doesn't exist."));        
        $this->files[]=$signed->getSignature()->getSignedFile()->getFile();        
        return $this;
    }
    
    
    function processSignedAhDocumentProof()
    {
        $signed =new DomoprimeYouSignEvidenceMeetingDocumentForm($this->getContract(),$this->getSite());
        if ($signed->isNotLoaded())
            throw new mfException(__("Document doesn't exist."));
        if (!$signed->isSigned())
            throw new mfException(__("Document is not signed."));
        if (!$signed->getSignature()->getProofFile()->isExist())
            $signed->getSignature()->downloadProof();
        if (!$signed->getSignature()->getProofFile()->isExist())
            throw new mfException(__("Proof document file doesn't exist."));                    
        $signed->getSignature()->getProofFile()->generatePdf();
        $this->files[]=$signed->getSignature()->getProofFile()->getPdf()->getFile();
        return $this;
    }
     
   
    function process()
    {       
        try
        {     
            if (!SystemResourceSettings::load($this->getSite())->hasResource('wkhtmltopdf'))
                throw new mfException(__("Resource 'wkhtmltopdf' is missing."));
            $this->processPremeeting();           
            $this->processFiscalVerifs();
            $this->processSignedFiscalVerifs();
            $this->processSignedQuotation();
            $this->processSignedQuotationProof();
            $this->processSignedAhDocument();
            $this->processSignedAhDocumentProof();          
            $this->processBilling();              
        } 
        catch (mfException $ex) {
            throw $ex;
        }
        return $this;
    }
      
    
    
   
}
