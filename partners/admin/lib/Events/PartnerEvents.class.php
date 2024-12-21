<?php



class PartnerEvents  {
     
    
    static function setExportModel(mfEvent $event)
    {                  
         if (!mfModule::isModuleInstalled('partners'))
             return ;
         // fields mfArray Class
          $event->getSubject()->getFields()->merge(PartnerExport::getFieldsForExport());      
    }
    
    static function setExportQueryForContract(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('partners'))
             return ;         
        if ($event->getSubject()->getFormat()->getSchema()->in(['contract.partner.name','contract.partner.siret']))
        { 
            $event->getSubject()->getQuery()->left(CustomerContract::getOuterForJoin('financial_partner_id'));                                        
            $event->getSubject()->setObject('Partner');
        }
    }
    
  
    
}
