<?php



class ServerServiceEvents  {
     
    
    static function setCreateSite(mfEvent $event)
    {                  
         if (!mfModule::isModuleInstalled('server_services'))
             return ;
         $site = $event->getSubject();  // site
                 
    }
    
    static function setCreateHost(mfEvent $event)
    {                  
         if (!mfModule::isModuleInstalled('server_services'))
             return ;
         //echo "<pre>"; var_dump($event->getSubject());
         $site = $event->getSubject();  // site
       
    }
    
    
    static function setExportSite(mfEvent $event)
    {                  
         if (!mfModule::isModuleInstalled('server_services'))
             return ;
         //echo "<pre>"; var_dump($event->getSubject());
         // $archive=new SiteArchive($this->site);
         $archive = $event->getSubject();  // SiteArchive
        
    }
  
    static function setWorkCreate(mfEvent $event)
    {                  
         if (!mfModule::isModuleInstalled('server_services'))
             return ;
         //echo "<pre>"; var_dump($event->getSubject());
       //   $work=new ServerArchiveWork();
         $work = $event->getSubject();  // SiteArchive
        
    }
}
