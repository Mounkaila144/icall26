<?php


class customers_meetings_importsInstall extends mfModuleInstall {
    
    
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
       $permission_group=new PermissionGroup('meetings',$site);      
       $permission=new Permission('meeting_import','admin',$site);
       $permission->add(array('name'=>'meeting_import','group_id'=>$permission_group))->save();    
       return true;
    }
    
}

