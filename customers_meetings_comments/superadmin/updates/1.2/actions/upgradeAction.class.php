<?php


class customers_meetings_comments_upgrade_12_Action extends mfModuleUpdate {
 
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
        $permission_group=new PermissionGroup('admin',$site); 
       foreach (array('meeting_comments_list_log') as $field)
       {    
            $permission=new Permission($field,'admin',$site);
            $permission->add(array('name'=>$field,'group_id'=>$permission_group))->save();  
       }
    }
}

