<?php




class customers_meetings_upgrade_23_Action extends mfModuleUpdate {
 
    function execute()
    {      
       $site=$this->getSite();         
       $permission_group=new PermissionGroup('meetings',$site); 
       
       foreach (array('meeting_display_type','meeting_display_callstatus',
                      'meeting_display_qualified',
                      'meeting_view_list_sale1','meeting_display_sale1', 'meeting_modify_sale1',
                      'meeting_view_list_sale2','meeting_display_sale2', 'meeting_modify_sale2',                      
                      'meeting_view_list_telepro','meeting_display_telepro','meeting_modify_telepro',
                      'meeting_view_list_assistant','meeting_display_assistant','meeting_modify_assistant',
                     ) as $field)
       {    
            $permission=new Permission($field,'admin',$site);
            $permission->add(array('name'=>$field,'group_id'=>$permission_group))->save();  
       }
      
    }
}

