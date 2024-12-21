<?php




class customers_meetings_upgrade_16_Action extends mfModuleUpdate {
 
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
       $permission_group=new PermissionGroup('meetings',$site);
       // Create permission
       $permission=new Permission('meeting_callback','admin',$site);
       $permission->add(array('name'=>'meeting_callback','group_id'=>$permission_group))->save();                
    }
}

