<?php

class moduleDownGradeTask extends mfTask {
        
    function configure() {
        $this->commandName='module';
        $this->addOptions(array(
            new mfOption('host', null, mfOption::PARAMETER_OPTIONAL, 'The host', null),
            new mfOption('module', null, mfOption::PARAMETER_OPTIONAL, 'The module name', null),
            new mfOption('env', null, mfOption::PARAMETER_OPTIONAL, 'The environment', 'prod'),
        ));
        $this->subCommandName = "downgrade";
    }
    
    function execute($arguments = array(), $options = array()) {
       $host = $options['host'];
       $module = $options['module'];
       $env = $options['env'];
       $_SERVER["REQUEST_URI"]="command";
       $_SERVER["SYSTEM_ENV"]=$env;
       $configuration=SystemConfiguration::getApplicationConfiguration('superadmin');
       // Force to be superadmin
       $_SERVER["HTTP_HOST"]=mfConfig::getSuperAdmin('host'); 
       $context=mfContext::createInstance($configuration);
       $site=new Site($host);
       if ($site->isNotLoaded())
       {
          echo sprintf("Site [%s] doesn't exist.\n",$host);
          return ;
       }    
       // Here we are superadmin
       try
       {
           $module=new mfModule($module,$site);
           $module->setInstallerClass('moduleUpdater');
           $module->getInstaller()->downGrade();
           if ($module->isDowngraded())
               echo sprintf("module [%s] versions [%s] are uninstalled.\n",$module->getModule(),implode(",",$module->getInstaller()->getVersionsDowngraded()));
           else
               echo sprintf("module [%s] no version.\n",$module->getModule()); 
       }
       catch (mfException $e)
       {
           echo $e->getMessage()."\n";
       }
    }
}




