<?php

class cronTask extends mfTask {
        
    function configure() {
        $this->commandName='cron';
        $this->addOptions(array(
            new mfOption('host', null, mfOption::PARAMETER_OPTIONAL, 'The site', null),
            new mfOption('name', null, mfOption::PARAMETER_OPTIONAL, 'The cron name', null),
            new mfOption('env', null, mfOption::PARAMETER_OPTIONAL, 'The environment', "prod"),
        ));
        $this->subCommandName = "exec";
    }
    
    function execute($arguments = array(), $options = array()) {
       echo "cron scheduler started.\n";
       $host = $options['host'];
       $env = $options['env'];      
       $cronName=$options['name'];
       $_SERVER["REQUEST_URI"]="command";
       $_SERVER["SYSTEM_ENV"]=$env;
       $_SERVER["SYSTEM_DEBUG"]=($env=='dev');
       $configuration=SystemConfiguration::getApplicationConfiguration('superadmin');
       // Force to be superadmin
       $_SERVER["HTTP_HOST"]=mfConfig::getSuperAdmin('host'); 
       $context=mfContext::createInstance($configuration);
       if (!$context->getFactory('cron')->run($cronName))
           echo sprintf("Error cron: cron name [%s] doesn't exist\n",$cronName);
       echo "cron scheduler terminated.\n";
    }
}

