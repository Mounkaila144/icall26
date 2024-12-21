<?php


/* 
settings_meeting_campaign
settings_meeting_statuscall
settings_meeting_type
 meeting_modify_callstatus
 meeting_display_state
 */

class customers_meetings_upgrade_21_Action extends mfModuleUpdate {
 
    function execute()
    {      
       $site=$this->getSite();         
       $permission_group=new PermissionGroup('meetings',$site);       
       $permission=new Permission('meeting_display_state','admin',$site);
       $permission->add(array('name'=>'meeting_display_state','group_id'=>$permission_group))->save();  
       
       $permission_group=new PermissionGroup('meetings',$site);   
       $permission=new Permission('meeting_modify_callstatus','admin',$site);
       $permission->add(array('name'=>'meeting_modify_callstatus','group_id'=>$permission_group))->save();
       
        $permission=new Permission('settings_meeting_statuscall','admin',$site);
       $permission->add(array('name'=>'settings_meeting_statuscall','group_id'=>$permission_group))->save(); 
       
        $permission=new Permission('settings_meeting_type','admin',$site);
       $permission->add(array('name'=>'settings_meeting_type','group_id'=>$permission_group))->save(); 
       
        $permission=new Permission('settings_meeting_campaign','admin',$site);
       $permission->add(array('name'=>'settings_meeting_campaign','group_id'=>$permission_group))->save(); 
    }
}

