<?php




class customers_meetings_upgrade_24_Action extends mfModuleUpdate {
 
    function execute()
    {      
       $site=$this->getSite();         
       $permission_group=new PermissionGroup('meetings',$site);        
       foreach (array('meeting_schedule_filter_confirmed',
                     ) as $field)
       {    
            $permission=new Permission($field,'admin',$site);
            $permission->add(array('name'=>$field,'group_id'=>$permission_group))->save();  
       }
      
    }
}

