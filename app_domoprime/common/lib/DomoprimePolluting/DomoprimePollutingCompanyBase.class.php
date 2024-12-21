<?php


class DomoprimePollutingCompanyBase extends PartnerPolluterCompanyBase{
    
    protected $partner_operations=null,$partner_surfaces=null,$partner_cumacs=null,$partner_quantities=null;
    
    function addOperation($type,$number_of_operations)
    {
        if ($this->partner_operations===null)     
            $this->partner_operations=new DomoprimeOperationCollection();            
        $this->partner_operations[$type]=$number_of_operations;
        return $this->partner_operations;
    }
    
    function getOperations()
    {
        if ($this->partner_operations===null)     
            $this->partner_operations=new DomoprimeOperationCollection();   
         return $this->partner_operations;
    }
    
    
    function addSurface($type,$number_of_surfaces)
    {
        if ($this->partner_surfaces===null)     
            $this->partner_surfaces=new DomoprimeSurfaceCollection();            
        $this->partner_surfaces[$type]=$number_of_surfaces;
        return $this->partner_surfaces;
    }
    
    function getSurfaces()
    {
        if ($this->partner_surfaces===null)     
            $this->partner_surfaces=new DomoprimeSurfaceCollection();   
         return $this->partner_surfaces;
    }
    
    function addCumac($type,$number_of_cumacs)
    {
        if ($this->partner_cumacs===null)     
            $this->partner_cumacs=new DomoprimeQmacCollection();            
        $this->partner_cumacs[$type]=$number_of_cumacs;
        return $this->partner_cumacs;
    }
    
    function getCumacs()
    {
        if ($this->partner_cumacs===null)     
            $this->partner_cumacs=new DomoprimeQmacCollection();   
         return $this->partner_cumacs;
    }
    
    function hasRecipient()
    {
        return $this->getRecipient();
    }
    
    function getRecipient()
    {
        if ($this->recipient===null)
        {
            $recipient=new DomoprimePolluterRecipient($this,$this->getSite()); 
            if ( $recipient->isNotLoaded())
                return false;
            $this->recipient=$recipient->getRecipient();
        }
        return $this->recipient;
    }
    
    function getPricings()
    {
        if ($this->pricings===null)
        {    
            $this->pricings=new DomoprimePolluterClassPricingCollection(null,$this->getSite());
            $db=mfSiteDatabase::getInstance()
                    ->setParameters(array('polluter_id'=>$this->get('id')))
                    ->setObjects(array('DomoprimePolluterClassPricing','DomoprimeClass'))
                    ->setQuery("SELECT {fields} FROM ". DomoprimePolluterClassPricing::getTable().  
                           " INNER JOIN ".DomoprimePolluterClassPricing::getOuterForJoin('class_id').                          
                           " WHERE ".DomoprimePolluterClassPricing::getTableField('polluter_id')."='{polluter_id}'".                               
                           ";")               
                    ->makeSiteSqlQuery($this->getSite()); 
         //   echo $db->getQuery(); die(__METHOD__);
            if (!$db->getNumRows())
                return $this->pricings;            
            while ($items=$db->fetchObjects())
            {               
               $this->pricings[$items->getDomoprimePolluterClassPricing()->get('id')]=$items->getDomoprimePolluterClassPricing()->set('class_id',$items->getDomoprimeClass());
            }    
        }
       return $this->pricings;
    }
    
    function hasQuotation()
    {
        return $this->getQuotation();
    }
    
    function getDocumentQuotation()
    {
         return $this->document_quotation=$this->document_quotation===null?new DomoprimePolluterQuotation($this,$this->getSite()):$this->document_quotation;          
    }
    
    function getQuotation()
    {
       if ($this->quotation===null)
        {           
            if ( $this->getDocumentQuotation()->isNotLoaded())
                return false;
            $this->quotation=$this->getDocumentQuotation()->getModel();
        }
        return $this->quotation; 
    }
    
    function hasBilling()
    {
        return $this->getBilling();
    }
    
    function getBilling()
    {
       if ($this->billing===null)
        {
            $billing=new DomoprimePolluterBilling($this,$this->getSite());             
            if ( $billing->isNotLoaded())
                return false;
            $this->billing=$billing->getModel();
        }
        return $this->billing; 
    }
    
    function getDocuments()
    {
       if ($this->documents===null)
        {    
            $this->documents=new PartnerPolluterDocumentCollection(null,$this->getSite());
            $db=mfSiteDatabase::getInstance()
                    ->setParameters(array('polluter_id'=>$this->get('id')))
                    ->setObjects(array('PartnerPolluterDocument','CustomerMeetingFormDocument'))
                    ->setQuery("SELECT {fields} FROM ". PartnerPolluterDocument::getTable().  
                           " INNER JOIN ".PartnerPolluterDocument::getOuterForJoin('document_id').                          
                           " WHERE ".PartnerPolluterDocument::getTableField('polluter_id')."='{polluter_id}'".                               
                           ";")               
                    ->makeSiteSqlQuery($this->getSite()); 
          // echo $db->getQuery();
            if (!$db->getNumRows())
                return $this->documents;                   
            while ($items=$db->fetchObjects())
            {                
              if (!$items->hasPartnerPolluterDocument())
                  continue;
               $item=$items->getPartnerPolluterDocument();               
               $item->set('document_id',$items->getCustomerMeetingFormDocument());
               $this->documents[$item->get('id')]=$item;
            }    
        }
       return $this->documents;                         
    }
    
     function hasPreMeeting()
    {
        return $this->getPreMeeting();
    }
    
    function getPreMeeting()
    {
        if ($this->premeeting===null)
        {
            $premeeting=new DomoprimePolluterPreMeeting($this,$this->getSite());             
            if ( $premeeting->isNotLoaded())
                return false;
            $this->premeeting=$premeeting->getModel();
        }
        return $this->premeeting; 
    }
    
     function hasAfterWork()
    {
        return $this->getAfterWork();
    }
    
    function getAfterWork()
    {
        if ($this->afterwork===null)
        {
            $afterwork=new DomoprimePolluterAfterWork($this,$this->getSite());             
            if ( $afterwork->isNotLoaded())
                return false;
            $this->afterwork=$afterwork->getModel();
        }
        return $this->afterwork; 
    }
    
     function hasProperties()
    {
        return $this->getProperties();
    }
    
    function getProperties()
    {
        if ($this->properties===null)
        {
            $this->properties=new DomoprimePolluterProperty($this,$this->getSite());             
            if ( $this->properties->isNotLoaded())
                return false;          
        }
        return $this->properties; 
    }
    
    function toXML() {
        $values=parent::toXML();
        if ($this->hasRecipient())            
            $values['recipient']=$this->getRecipient()->toXML();                   
        if ($this->hasBilling())                              
            $values['billing']=$this->getBilling()->toXML();            
        if ($this->hasQuotation())            
            $values['quotation']=$this->getQuotation()->toXML(); 
        if ($this->hasPreMeeting())           
            $values['premeeting']=$this->getPreMeeting()->toXML();      
          if ($this->hasAfterWork())           
            $values['afterwork']=$this->getAfterWork()->toXML();      
        if ($this->hasProperties())            
            $values['properties']=$this->getProperties()->toXML();     
        if ($this->getDocumentQuotation() && $this->getDocumentQuotation()->isLoaded())            
            $values['document_quotation']=$this->getDocumentQuotation()->toXML(); 
        return $values;
    }
    
     function getActiveCompaniesForSelect(){       
         $values=new mfArray();
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array('type'=>$this->get('type')))
                ->setQuery("SELECT name,id FROM ".self::getTable().
                           " WHERE is_active='YES' AND type='{type}' ORDER BY name ASC;")               
                ->makeSiteSqlQuery($this->getSite()); 
        if (!$db->getNumRows())
            return $values;
        while ($row=$db->fetchArray())
        { 
            $values[$row['id']]=$row['name'];
        }                
        return $values;
    }
    
    
     function addQuantity($type,$number_of_quantities)
    {
        if ($this->partner_quantities===null)     
            $this->partner_quantities=new DomoprimeSurfaceCollection();            
        $this->partner_quantities[$type]=$number_of_quantities;
        return $this->partner_quantities;
    }
    
    function getQuantities()
    {
        if ($this->partner_quantities===null)     
            $this->partner_quantities=new DomoprimeSurfaceCollection();   
         return $this->partner_quantities;
    }
    
}
