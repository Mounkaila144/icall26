<?php



class SiteServiceEvents  {
     
    
    static function setCreateSite(mfEvent $event)
    {                  
         if (!mfModule::isModuleInstalled('site_services'))
             return ;
           // if (mfModule::isModuleInstalled('services_online'))
       //      return ;
         $site = $event->getSubject();  // site
         //   echo "++++"  ;
    }
    
    static function setCreateHost(mfEvent $event)
    {                  
         if (!mfModule::isModuleInstalled('site_services'))
             return ;
        // if (mfModule::isModuleInstalled('services_online'))
       //      return ;
         //echo "<pre>"; var_dump($event->getSubject());
         $site = $event->getSubject();  // Site
       //  echo "---"  ;
    }
    
    static function setExportSite(mfEvent $event)
    {                  
         if (!mfModule::isModuleInstalled('site_services'))
             return ;
         //echo "<pre>"; var_dump($event->getSubject());
         // $archive=new SiteArchive($this->site);
         $archive = $event->getSubject();  // SiteArchive
         
    }
   
}
