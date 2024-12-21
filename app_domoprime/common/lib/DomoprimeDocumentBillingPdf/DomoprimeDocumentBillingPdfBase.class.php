<?php


                
class DomoprimeDocumentBillingPdfBase extends UtilDocumentPdfBase {
     
    
    function getDocumentClass()
    {
        return "DomoprimeBillingPdfBatch";
    }
    
    function getDocumentMethod()
    {
        return "Process";
    }
    
    function getDocumentName()
    {
        return "DomoprimeBilling";
    }
    
    function getDocumentModule()
    {
        return "app_domoprime";
    }
    
    function setSignature()
    {
        $this->set('signature',sha1($this->get('name').$this->get('parameters').$this->get('user_id')));
    }
    
    function setUserAndParameters(mfArray $selection,User $user)
    {
        $this->set('parameters',$selection->implode(','));
        $this->set('number_of_documents',$selection->count());
        $this->set('user_id',$user);   
        $this->setSignature();
        return $this;
    }
    
    function create()
    {
        return $this->save();
    }
    
    function isValid()
    {
        if ($this->is_valid===null)
        {
            // CHeck if all contracts have quotation          
            $this->is_valid=  $this->getContractsWithoutQuotations()->isEmpty();
        }    
        return $this->is_valid;
    }
    
    
    function getContractsWithoutQuotations()
    {
        if ($this->contracts_without_quotations===null)
        {
             $this->contracts_without_quotations=DomoprimeQuotation::checkIfContractsWithQuotationFromSelection($this->getParameters(),$this->getSite());                 
        }    
        return $this->contracts_without_quotations;
    }
}
