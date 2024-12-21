<?php

 
return array(
    //   "modules_manager_list_moduleManager"=>array("pattern"=>'/modules/manager/admin',"module"=>"modules_manager","action"=>"listModuleManager"),
       "modules_manager_ajax"=>array("pattern"=>'/module/modules/manager/admin/{action}',"module"=>"modules_manager","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
    
     //  "modules_manager_export_moduleManagerAdmin"=>array("pattern"=>'/sites/modules/manager/admin/Export{type}ModuleAdmin',"module"=>"modules_manager","action"=>"Export{type}ModuleAdmin","requirements"=>array("type"=>"Zip")),              
     //  "modules_manager_list_moduleManagerAdmin"=>array("pattern"=>'/sites/modules/manager/admin',"module"=>"modules_manager","action"=>"listModuleManagerAdmin"),
       "modules_manager_ajax_moduleManagerAdmin"=>array("pattern"=>'/module/sites/modules/manager/admin/{action}',"module"=>"modules_manager","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
       
              
                   
       

  );
 