<?php


class customers_meetings_upgrade_10_Action extends mfModuleUpdate {
 
    function execute()
    {      
       $site=$this->getSite();     
       // Permission Group 
        $permission_group=new PermissionGroup('meetings',$site);
       // Permission
        $permission=new Permission('meeting_modify_state','admin',$site);
        $permission->set('group_id',$permission_group);
        $permission->save();             
        // Group / Permission
      //  $group_permission=new GroupPermission(array('group_id'=>$permission_group->get('id'),'permission_id'=>$permission->get('id')),$site);
      //  $group_permission->save();
    }
}

