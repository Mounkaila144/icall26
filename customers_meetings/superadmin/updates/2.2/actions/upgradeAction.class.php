<?php

/*
 * meeting_display_callstatus
 * meeting_view_list_qualification
 * meeting_view_list_state
 * meeting_view_list_campaign
 * meeting_view_list_callcenter
 * meeting_view_list_type
 * meeting_view_list_callstatus
 * meeting_view_list_confirmed
 * meeting_view_list_status
 * meeting_view_list_team
 */


/* 2.3
 * meeting_display_type
 * meeting_display_callstatus
 * meeting_display_qualified
 * 
 */

class customers_meetings_upgrade_22_Action extends mfModuleUpdate {
 
    function execute()
    {      
       $site=$this->getSite();         
       $permission_group=new PermissionGroup('meetings',$site); 
       
       foreach (array('meeting_display_callstatus','meeting_view_list_qualification',
                        'meeting_view_list_state','meeting_view_list_campaign',
                        'meeting_view_list_callcenter','meeting_view_list_type',
                        'meeting_view_list_callstatus','meeting_view_list_confirmed',
                        'meeting_view_list_status','meeting_view_list_team') as $field)
       {    
            $permission=new Permission($field,'admin',$site);
            $permission->add(array('name'=>$field,'group_id'=>$permission_group))->save();  
       }
      
    }
}

