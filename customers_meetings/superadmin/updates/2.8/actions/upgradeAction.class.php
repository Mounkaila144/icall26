<?php




class customers_meetings_upgrade_28_Action extends mfModuleUpdate {
 
    function execute()
    {      
       $site=$this->getSite();                
       $permission=new Permission('meeting_view_modify_lead_status','admin',$site);
       $permission->delete();
       $permission_group=new PermissionGroup('meetings',$site); 
       foreach (array(
                      'meeting_modify_lead_status'
           ) as $field)
       {    
            $permission=new Permission($field,'admin',$site);
            $permission->add(array('name'=>$field,'group_id'=>$permission_group))->save();  
       }
    }
}

