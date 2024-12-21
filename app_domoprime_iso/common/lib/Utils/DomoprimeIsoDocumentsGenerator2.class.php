<?php


class DomoprimeIsoDocumentsGenerator2 extends DomoprimeIsoDocumentsGenerator {
    
    function processQuotation()
    {        
        // Quotation
          $this->quotation=new DomoprimeQuotation(null,$this->getSite());         
          $this->quotation->createFromItemsAndContract($this->getContract(),$this->getUser());
          $model=null;
          if ($this->quotation->getContract()->hasPolluter())
          {              
              $polluter_quotation_model=new DomoprimePolluterQuotation($this->quotation->getContract()->getPolluter());
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
    
    function processFiscalVerifs()
    {
         if ($this->getSettings()->get('verif_archivage')!='YES')
             return $this;
         $customer_verif=new ServiceImpotVerifCustomer($this->getContract(),$this->getSite());         
         foreach ($customer_verif->getRequests() as $verif)
         {
             if (!$verif->hasFile())             
                $verif->generatePdf();               
             if ($verif->hasFile())
                 $this->files[]=$verif->getFile()->getFile();
         }            
         return $this;
    }
    
    function processSignedFiscalVerifs()
    {       
         if ($this->getSettings()->get('signed_verif_archivage')!='YES')
             return $this;         
         $customer_verif=new ServiceImpotVerifCustomer($this->getContract(),$this->getSite());         
         foreach ($customer_verif->getRequests() as $verif)
         {                                     
             $verif->generateSignedPdf();                         
              if ($verif->hasPdfWithSignature())
                 $this->files[]=$verif->getPdfWithSignature()->getFile();            
         }            
         return $this;
    }
    
   
    function process()
    {
        try
        {
            $this->processEngine();            
            $this->processPremeeting();           
            $this->processFiscalVerifs();
            $this->processSignedFiscalVerifs();
            $this->processQuotation();
            $this->processAhDocuments();           
            $this->processBilling();                                         
        } 
        catch (mfException $ex) {
            throw $ex;
        }
        return $this;
    }
      
    
    
   
}
