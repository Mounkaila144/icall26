<?php




class customers_meetings_upgrade_27_Action extends mfModuleUpdate {
 
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
       foreach (array('meeting_display_lead_status',
                      'meeting_view_list_lead_status',
                      'meeting_view_modify_lead_status'
           ) as $field)
       {    
            $permission=new Permission($field,'admin',$site);
            $permission->add(array('name'=>$field,'group_id'=>$permission_group))->save();  
       }
    }
}

