<?php



class customers_meetings_upgrade_34_Action extends mfModuleUpdate {
 
    function execute()
    {      
       $site=$this->getSite();                              
       $permission_group=new PermissionGroup('meetings',$site); 
       foreach (array('meeting_view_all','meeting_view_telepro','meeting_view_sale','meeting_view_assistant') as $field)
       {    
            $permission=new Permission($field,'admin',$site);
            $permission->add(array('name'=>$field,'group_id'=>$permission_group))->save();  
       }
    }
}

