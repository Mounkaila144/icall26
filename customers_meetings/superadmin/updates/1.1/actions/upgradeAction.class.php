<?php


class customers_meetings_upgrade_11_Action extends mfModuleUpdate {
 
    function execute()
    {      
       $site=$this->getSite();     
            
       //  Permission Group
       $permission_group=new PermissionGroup('admin',$site);
       // Create permission
       $permission=new Permission('meeting_modify_created_date','admin',$site);
       $permission->add(array('name'=>'meeting_modify_created_date','group_id'=>$permission_group))->save();                     
       // Create group
       $group=new Group('admin','admin',$site);                      
       // Permission / Group
       $group_permission=new GroupPermission(array('group_id'=>$group,'permission_id'=>$permission),$site);
       $group_permission->add(array('group_id'=>$group,'permission_id'=>$permission))->save();
    }
}

