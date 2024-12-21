<?php

/*
 * 
 */


class customers_meetings_upgrade_17_Action extends mfModuleUpdate {
 
    function execute()
    {      
       $site=$this->getSite();        
       $permission_group=new PermissionGroup('meetings',$site);
       // Create permission
       $permission=new Permission('meeting_modify_sales','admin',$site);
       $permission->add(array('name'=>'meeting_modify_sales','group_id'=>$permission_group))->save();                
    }
}

