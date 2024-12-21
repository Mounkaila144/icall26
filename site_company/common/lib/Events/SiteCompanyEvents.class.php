<?php



class SiteCompanyEvents  {
     
    
    
     static function initializationExecute(mfEvent $event)
    {               
         $form=$event->getSubject();
         if (!mfModule::isModuleInstalled('site_company',$form->getSite()))
             return ;            
         SiteCompany::initializeSite($form->getSite());
    }
}
