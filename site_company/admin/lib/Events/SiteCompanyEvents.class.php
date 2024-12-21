<?php



class SiteCompanyEvents  {
     
   
   
    static function setExportModel(mfEvent $event)
    {                  
         if (!mfModule::isModuleInstalled('site_company'))
             return ;
         // fields mfArray Class
         
        $event->getSubject()->getFields()->merge(SiteCompanyExport::getFieldsForExport());      
    }
    
  /*  static function setExportQuery(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('app_domoprime'))
             return ;         
        $event->getSubject()->getQuery()
                ->left(DomoprimeCalculation::getInnerForJoin('meeting_id'). " AND ".DomoprimeCalculation::getTableField("isLast='YES'"))
                ->left(DomoprimeProductCalculation::getInnerForJoin('calculation_id'));
        $event->getSubject()->setObject('DomoprimeCalculation');
    }*/
    
   
    
   /*  static function setExportQueryForContract(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('app_domoprime'))
             return ;       
       
    }*/
    
    
    
}
