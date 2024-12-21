<?php



class customers_meetings_upgrade_37_Action extends mfModuleUpdate {
 
    function execute()
    {      
       $site=$this->getSite();                              
       $permission_group=new PermissionGroup('meetings',$site); 
       foreach (array('meeting_view_list_createdby','meeting_display_createdby',
                      'meeting_modify_createdby','meeting_export_createdby') as $field)
       {    
            $permission=new Permission($field,'admin',$site);
            $permission->add(array('name'=>$field,'group_id'=>$permission_group))->save();  
       }
    }
}

