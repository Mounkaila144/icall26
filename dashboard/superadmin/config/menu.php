<?php

return array(
    
  
  "menu"=>array(                   
                    "dashboard"=>array(
                      //  "title"=>"home",
                      //  "route"=>array(""=>""),
                      //  "route_ajax"=>array(""=>""),
                      //  "urlAjax"=>"/module/admin", 
                        "icon"=>"/pictures/icons/home.gif",
                       // "childs"=>array('sites_admin'=>null,'dashboard_home'=>null,'dashboard_settings'=>null),
                    ),  
      
                    "dashboard_home"=>array(
                       "component"=>"/dashboard/menuItemHome",
                       "credentials"=>array(array('superadmin')),
                       "title"=>"Super Administration",
                       "route"=>array("dashboard_index"=>array()),
                       "route_ajax"=>array("dashboard_ajax"=>array('action'=>'Index')),
                  //   "url"=>"/",
                   //  "enabled"=>true,   
                       "childs"=>array("dashboard_cache"=>null,"dashboard_logs"=>"null","dashboard_multiple"=>null),                 
                   //  "childs"=>array("dashboard_languages"=>'',"dashboard_users"=>'',"dashboard_groups"=>'','dashboard_permissions'=>'',"dashboard_preferences"=>'',"dashboard_cache"=>''),
                      ),
      
                      
  ),
    
  "items"=>array(
      "dashboard_cache"=>array(    
                    "title"=>"Cache",  
                    "component"=>"/dashboard/menuItemCache",     
                    "route_ajax"=>array('dashboard_ajax'=>array('action'=>'Cache')),
                    "help"=>"cache administration",
                    "credentials"=>array(array('superadmin','admin')),
                    "enabled"=>true,                         
       ), 
        "dashboard_logs"=>array(   
                    "title"=>"Logs",
                    "component"=>"/dashboard/menuItemLogs",     
                    "route_ajax"=>array('dashboard_ajax'=>array('action'=>'ListLog')),
                    "help"=>"cache administration",
                     "credentials"=>array(array('superadmin','admin')),
                    "enabled"=>true,                         
       ), 
      
       "dashboard_multiple"=>array(   
                    "title"=>"Mutiple actions",
                    "component"=>"/dashboard/menuItemMultiple",     
                    "route_ajax"=>array('dashboard_ajax'=>array('action'=>'MultipleActions')),
                   // "help"=>"cache administration",
                     "credentials"=>array(array('superadmin','admin')),
                    "enabled"=>true,                         
       ), 
  ),
  /*  "items"=>array(   
    // DASHBOARD              
               "dashboard_superadmin"=>array(
                     "title"=>"Super Administration",
                  //   "url"=>"/",
                     "enabled"=>true,
                     "module"=>"site",
                     "childs"=>array("dashboard_languages"=>'',"dashboard_users"=>'',"dashboard_groups"=>'','dashboard_permissions'=>'',"dashboard_preferences"=>'',"dashboard_cache"=>''),
                 ),
      
                 "dashboard_myaccount"=>array(
                    "title"=>"my account",
                    "credentials"=>array(),
                    "enabled"=>true,
                    "module"=>"dashboard",
                    "childs"=>array("dashboard_identity"=>'')
                    ), 
      
                "dashboard_cache"=>array(
                    "title"=>"cache",
                    "url"=>"/cache",
                    "picture"=>"/pictures/icons/log.png",
                    "enabled"=>true,
                    "module"=>"dashboard"
                    ),        
                "dashboard_users"=>array(
                    "title"=>"users",
                    "url"=>"/dashboard/users",
                    "urlAjax"=>"/module/dashboard/users/List",
                    "picture"=>"/pictures/icons/users.png",
                    "help"=>"users administration",
                    "credentials"=>array(array('superadmin','admin')),
                    "enabled"=>true,
                    "module"=>"dashboard"
                    ),  
                "dashboard_preferences"=>array(
                    "title"=>"preferences",
                    "url"=>"/dashboard/preferences",
                    "picture"=>"/pictures/icons/theme.png",
                    "credentials"=>array(),
                    "enabled"=>true,
                    "module"=>"site"
                    ), 
                "dashboard_permissions"=>array(
                    "title"=>"permissions",
                    "url"=>"/dashboard/permissions",
                    "picture"=>"/pictures/icons/access.png",
                    "help"=>"permissions administration",
                    "credentials"=>array(),
                    "enabled"=>true,
                    "module"=>"site"
                    ), 
                "dashboard_groups"=>array(
                    "title"=>"groups",
                    "url"=>"/dashboard/groups",
                    "picture"=>"/pictures/icons/groups.png",
                    "help"=>"groups administration",
                    "credentials"=>array(),
                    "enabled"=>true,
                    "module"=>"site"
                    ), 
                "dashboard_languages"=>array(
                    "title"=>"languages",
                    "url"=>"/dashboard/languages",
                    "picture"=>"/pictures/icons/languages.png",
                    "help"=>"languages administration",
                    "credentials"=>array(),
                    "enabled"=>true,
                    "module"=>"dashboard"
                    ), 
      
                "dashboard_identity"=>array(
                    "title"=>"identity",
                    "url"=>"/account/identity",
                    "picture"=>"/pictures/icons/identity.png",
                    "help"=>"identity administration",
                    "credentials"=>array(),
                    "enabled"=>true,
                    "module"=>"dashboard"
                    ), 
                  
   ),   
    
   "menu"=>array(                   
                    "dashboard"=>array(
                        "title"=>"home",
                        "route"=>array(""=>""),
                        "route_ajax"=>array(""=>""),
                      //  "urlAjax"=>"/module/admin", 
                        "icon"=>"/pictures/icons/home.gif",
                        "childs"=>array('sites_admin'=>'','dashboard_superadmin'=>'','dashboard_myaccount'=>''),
                    ), 
  )*/
);