<?php


return array(
    
    "menu"=>array(                   
        "dashboard_home"=>array(                     
            "childs"=>array("dashboard_module_manager"=>null),                                 
        ),
    ),

    "items"=>array(
      
        "dashboard_module_manager"=>array(
            "title"=>"module manager",
            "component"=>"/modules_manager/menuItemAdmin",     
            "route_ajax"=>array('modules_manager_ajax_moduleManagerAdmin'=>array('action'=>'ListModuleManagerAdmin')),
            "help"=>"cache administration",
            //  "credentials"=>array(array('superadmin','admin')),
            "enabled"=>true,                         
        ), 
      
        "site_admin"=>array(                   
            "childs"=>array("site_module"=>''),                   
        ),   
     
        "site_module"=>array(
            "title"=>"Module Manager",
            "route_ajax"=>array("modules_manager_ajax"=>array("action"=>"ListModuleManager")),                  
            "picture"=>"/pictures/icons/system.png",
            "help"=>"modify, add and delete site languages",                 
        ),   
    ),
    /*
    "items"=>array(   
                    "site_admin"=>array("childs"=>array("site.admin.admin_module_manager"=>'',)
                
                ),                   
    // CHILDS     
    "site.admin.admin_module_manager"=>array(
        "title"=>"module manager admin",
        "url"=>"/modules/manager/admin",
        "urlAjax"=>"/module/modules/manager/admin/ListModuleManager",
        "picture"=>"/pictures/icons/system.png",
        "help"=>"module administration manager",
        "credentials"=>array(),
        "enabled"=>true,
        "module"=>"",
    ),
                
    // SITES
    "sites_admin"=>array("childs"=>array("sites.admin.admin_module_manager"=>'',)
                
    ),                   
    // CHILDS     
    "sites.admin.admin_module_manager"=>array(
        "title"=>"module manager admin",
        "url"=>"/sites/modules/manager/admin",
        "urlAjax"=>"/module/sites/modules/manager/admin/ListModuleManagerAdmin",
        "picture"=>"/pictures/icons/system.png",
        "help"=>"module administration manager admin",
        "credentials"=>array(),
        "enabled"=>true,
        "module"=>"",
    ),
      
    ), */
);