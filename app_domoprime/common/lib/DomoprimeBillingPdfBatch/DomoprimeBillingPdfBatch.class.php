<?php

class DomoprimeBillingPdfBatch {
    
    protected $work=null,$site=null,$model=null,$file=null;
    
    function __construct(UtilDocumentPdf $work) {
       
        $this->work=$work;
        $this->site=$this->getWork()->getSite();
        $this->model=DomoprimeSettings::load($this->getSite())->getModelForBilling();          
        if ($this->model->isNotLoaded())
              throw new mfException( __("Model is invalid."));
    }
    
    function getSite()
    {
        return $this->site;
    }
      
    function getModel()
    {
        return $this->model;
    }
    
    function getWork()
    {
        return $this->work;
    }
    
    function process()
    {             
      //  echo "Work=".$this->getWork()->get('id')." Contract=".$this->getWork()->get('current')."<br/>";        
        $contract=new CustomerContract($this->getWork()->get('current'),$this->getSite());
        if ($contract->isNotLoaded())
            throw new mfException(__('Contract is invalid.'));
        // takes last quotation by contract            
        $quotation=new DomoprimeQuotation($contract,$this->getSite());
        if ($quotation->isNotLoaded())
                throw new mfException(__('Quotation for contract [%s](%s) is invalid.',array((string)$contract->getCustomer(),$contract->get('id'))));
        $billing=new DomoprimeBilling($quotation,$this->getSite());     
        if ($billing->isNotLoaded())
        {    
            $billing->createFromQuotationWithUser($contract,$quotation,$this->getWork()->getUser());
            $contract->setClosedAtFromOpcAt();
        }      
        $pdf=new DomoprimeBillingPDF($this->getModel(),$billing);  
        if (!is_readable($pdf->getFilename()))
            $pdf->save();    
        $this->file=$pdf->getFilename();        
        return $this;
    }
    
    function getFile()
    {
      return $this->file;
    }
    
}
