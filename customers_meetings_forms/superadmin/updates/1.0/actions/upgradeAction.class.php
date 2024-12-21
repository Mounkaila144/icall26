<?php


class customers_meetings_forms_upgrade_10_Action extends mfModuleUpdate {
 
    function execute()
    {      
       $site=$this->getSite();   
       $permission_group=new PermissionGroup('admin',$site);
       // Create permission
       $permission=new Permission('meetings_forms','admin',$site);
       $permission->add(array('name'=>'"meetings_forms','group_id'=>$permission_group))->save();                    
    }
}

