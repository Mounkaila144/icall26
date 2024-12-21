<?php



class customers_meetings_upgrade_38_Action extends mfModuleUpdate {
 
    function execute()
    {      
       $site=$this->getSite();                              
       $permission_group=new PermissionGroup('meetings',$site); 
       foreach (array('meeting_view_duplicate_phone_list','meeting_view_duplicate_mobile_list',
                    'meeting_view_duplicate_phone_confirmed_list') as $field)
       {    
            $permission=new Permission($field,'admin',$site);
            $permission->add(array('name'=>$field,'group_id'=>$permission_group))->save();  
       }
    }
}

