<?php


class mfModuleConfigHandlerAdmin extends mfModuleConfigHandler {          
    
  function execute($configFiles) {                       
       $classModuleManager=$this->getParameters()->get('class');     
        if ($classModuleManager && class_exists($classModuleManager))
        {        
            $configFiles=$classModuleManager::getInstance()->getConfigFiles($configFiles);                  
        }                 
       return parent::execute($configFiles);
    }
}

