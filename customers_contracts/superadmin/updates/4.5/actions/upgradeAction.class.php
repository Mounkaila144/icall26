<?php


class customers_contracts_upgrade_45_Action extends mfModuleUpdate {
 
    function execute()
    {      
       $site=$this->getSite();  

   /*    if (in_array($site->get('site_db_name'),array(
'site_demodev','site_expodev2','site_expodev','site_gehx','site_gidf2dg','site_iso10dev',
'site_iso11','site_iso4dev','site_iso9devsite_iso9sav','site_isodev2','site_isodev',
'site_isolation','site_isoxxdev1','site_isoxxdev','site_lead','site_market','site_model','site_theme24')))
               return ;*/
       
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

