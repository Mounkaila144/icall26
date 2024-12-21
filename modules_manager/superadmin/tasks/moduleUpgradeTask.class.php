<?php

class moduleUpgradeTask extends mfTask {
        
    function configure() {
        $this->commandName='module';
        $this->addOptions(array(
            new mfOption('host', null, mfOption::PARAMETER_OPTIONAL, 'The host', null),
            new mfOption('site', null, mfOption::PARAMETER_OPTIONAL, 'The site', null),
            new mfOption('module', null, mfOption::PARAMETER_OPTIONAL, 'The module name', null),
            new mfOption('env', null, mfOption::PARAMETER_OPTIONAL, 'The environment', 'prod'),
        ));
        $this->subCommandName = "upgrade";
    }
    
    function execute($arguments = array(), $options = array()) {
       $host = $options['host'];
       $siteName = $options['site'];
       $modules =(array) $options['module'];
       $env = $options['env'];
       $_SERVER["REQUEST_URI"]="command";
       $_SERVER["SYSTEM_ENV"]=$env;
       $configuration=SystemConfiguration::getApplicationConfiguration('superadmin');
       // Force to be superadmin
       $_SERVER["HTTP_HOST"]=mfConfig::getSuperAdmin('host'); 
       $context=mfContext::createInstance($configuration);
       if ($host || $siteName)
       {   
          // $site=($host)?new Site($host):new Site(array('site_db_name'=>$siteName));
           $site=new Site(($host?$host:array('site_db_name'=>$siteName)));
           if ($site->isNotLoaded())
           {
              echo sprintf("Error : Site [%s] doesn't exist.\n",$host);
              return ;
           }
           $sites=array($site);
       }
       else
       {
           $sites=sitesAdmin::getlistSiteName();
       }
       // All modules ?
       if (!$modules)
           $modules=moduleUtils::getModules(); 
       foreach ($sites as $site)
       {    
           echo sprintf("site [%s] upgrade in progress.\n",$site->getSiteName()); 
           foreach ($modules as $module)
           {   
               try
               {
                    $module=new mfModule($module,$site);
                    $module->setInstallerClass('moduleUpdater');
                    if ($module->isUpToDate())
                    {    
                        echo sprintf("module [%s] is up to date version [%s].\n",$module,$module->getInstaller()-> getSiteLastVersion()); 
                        continue;
                    }                 
                    $module->getInstaller()->upGrade();                
                 //   if ($moduleUpdater->getVersionsUpgraded())
                    echo sprintf("module [%s] versions [%s] are updated.\n",$module,implode(",",$module->getInstaller()->getVersionsUpgraded()));     
                 //   else
                 //    echo sprintf("module [%s] is up to date version [%s].\n",$module,$moduleUpdater->getSiteLastVersion()); 
               }               
               catch (mfException $e)
               {
                  echo "Error : ".$e->getMessage()."\n"; 
               }
           }    
       }    
    }
}




