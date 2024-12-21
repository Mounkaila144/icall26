<?php


class customers_contracts_upgrade_62_Action extends mfModuleUpdate {
 
    function execute()
    {      
       $site=$this->getSite();         
       $files=array(
              $this->getModelsPath()."/upgrade.sql",               
              );              
       $importDB=importDatabase::getInstance();           
       foreach ($files as $file)
       {    
           if (!is_readable($file))
               continue;          
           $importDB->import($file,$site);
           @copy($file, $this->getUpdateDirectory()."/".basename($file));
       }    
       
       
       if (mfModule::isModuleInstalled('partners_polluter',$site))
       {
          $file = $this->getModelsPath()."/upgrade-polluter.sql";
          ImportDatabase::getInstance()->import($file,$site);
          @copy($file, $this->getUpdateDirectory()."/".basename($file));
       }        
    }
}

