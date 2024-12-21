<?php



class customers_meetings_upgrade_31_Action extends mfModuleUpdate {
 
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
       foreach (array('meeting_view_list_treatment_date','meeting_display_treatment_date','meeting_modify_treatment_date'
                     ) as $field)
       {    
            $permission=new Permission($field,'admin',$site);
            $permission->add(array('name'=>$field,'group_id'=>$permission_group))->save();  
       }
    }
}

