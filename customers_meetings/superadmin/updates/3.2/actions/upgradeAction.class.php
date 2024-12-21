<?php



class customers_meetings_upgrade_32_Action extends mfModuleUpdate {
 
    function execute()
    {      
       $site=$this->getSite();                              
       $permission_group=new PermissionGroup('meetings',$site); 
       foreach (array('meeting_view_list_creation_date','meeting_display_creation_date') as $field)
       {    
            $permission=new Permission($field,'admin',$site);
            $permission->add(array('name'=>$field,'group_id'=>$permission_group))->save();  
       }
    }
}

