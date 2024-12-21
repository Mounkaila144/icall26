<?php


class customers_contracts_upgrade_44_Action extends mfModuleUpdate {
 
    function execute()
    {      
       $site=$this->getSite();   
       if (!mfModule::isModuleInstalled('products_items', $site))
           return ;
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
       
    }
}
