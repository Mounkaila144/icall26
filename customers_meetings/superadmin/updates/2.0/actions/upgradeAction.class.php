<?php




class customers_meetings_upgrade_20_Action extends mfModuleUpdate {
 
    function execute()
    {      
       $site=$this->getSite();  
       $files=array(
              $this->getModelsPath()."/upgrade.sql",               
              );              
       $importDB=importDatabase::getInstance();           
       foreach ($files as $file)
       {    
           if (!is_readable($file))
               continue;          
           $importDB->import($file,$site);
           @copy($file, $this->getUpdateDirectory()."/".basename($file));
       }  
       $permission_group=new PermissionGroup('meetings',$site);
       // meeting_modify_type       
       $permission=new Permission('meeting_modify_type','admin',$site);
       $permission->add(array('name'=>'meeting_modify_type','group_id'=>$permission_group))->save();         
       // meeting_modify_callcenter
        $permission=new Permission('meeting_modify_callcenter','admin',$site);
       $permission->add(array('name'=>'meeting_modify_callcenter','group_id'=>$permission_group))->save();  
       // meeting_modify_campaign
       $permission=new Permission('meeting_modify_campaign','admin',$site);
       $permission->add(array('name'=>'meeting_modify_campaign','group_id'=>$permission_group))->save();  
       // meeting_modify_qualified
       $permission=new Permission('meeting_modify_qualified','admin',$site);
       $permission->add(array('name'=>'meeting_modify_qualified','group_id'=>$permission_group))->save(); 
       // filter_meeting_callcenter
       $permission_group=new PermissionGroup('filters',$site);
       $permission=new Permission('filter_meeting_callcenter','admin',$site);
       $permission->add(array('name'=>'filter_meeting_callcenter','group_id'=>$permission_group))->save(); 
    }
}

