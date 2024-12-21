<?php


class app_domoprime_isoInstall extends mfModuleInstall {
    
    
    function execute()
    {
       $site=$this->getSite();    
       $files=array(
           $this->getModelsPath()."/schema.sql",
           $this->getDataPath()."/data.sql"
       );
       $importDB=importDatabase::getInstance();
       foreach ($files as $file)
       {    
           if (!is_readable($file))
               continue;
           $importDB->import($file,$site);
           @copy($file, $this->getInstallPath()."/".basename($file));
       }       
       $settings=new DomoprimeIsoSettings(null,$site);
       $settings->set('mode','DATABASE')->save();
       // Install new groups       
       ImportFileGroupProcess::createFromDirectory($this->getDataPath()."/groups",$site);
       // create quotations
       DomoprimeQuotationModel::createFromDirectory($this->getDataPath()."/quotations",$site);               
       // create billings                  
       DomoprimeBillingModel::createFromDirectory($this->getDataPath()."/billings",$site);   
       // Replace variables
       DomoprimeIsoUtils::migrateModels($site);
       return true;
    }
    
}

