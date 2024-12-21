<?php


class customers_contracts_upgrade_13_Action extends mfModuleUpdate {
 
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
       $permission_group=new PermissionGroup('contracts',$site); 
       foreach (array(
                      'contract_view_list_assistant','contract_display_assistant','contract_modify_assistant',
                     ) as $field)
       {    
            $permission=new Permission($field,'admin',$site);
            $permission->add(array('name'=>$field,'group_id'=>$permission_group))->save();  
       }
    }
}

