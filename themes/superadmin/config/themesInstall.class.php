<?php


class themesInstall extends mfModuleInstall {
    
    
    function execute()
    {
       $site=$this->getSite();
       // Theme sur site
       $files=array(
           $this->getModelsPath()."/schema.sql",
         //  $this->getDataPath()."/data.sql"
       );
       // Themes sur admin
       if ($site->isSuperAdmin())
       {
          $files[]= $this->getModelsPath()."/schema_superadmin.sql";        
       }    
       $importDB=importDatabase::getInstance();
       foreach ($files as $file)
       {    
           if (!is_readable($file))
               continue;
           $importDB->import($file,$site);
           @copy($file, $this->getInstallPath()."/".basename($file));
       }       
       // Find all existing themes
       if ($site->isSuperAdmin())
            ThemesUtils::refresh();
       $theme_fe=new Theme(null,'frontend',$site);
       $theme_fe->set('name',$site->get('site_frontend_theme'));
       $theme_fe->set('is_active','YES');
       $theme_fe->save();
       
       $theme_admin=new Theme(null,'admin',$site);
       $theme_admin->set('name',$site->get('site_admin_theme'));
       $theme_admin->set('is_active','YES');
       $theme_admin->save();            
       return true;
    }
    
}

