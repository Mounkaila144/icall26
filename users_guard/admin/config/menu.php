<?php

return array(
    "items"=>array(      
      
          "site_users"=>array(                           
                     "childs"=>array(//'site.users.permissions.admin'=>'',
                         "site.users.groups.admin"=>''),                    
                 ),   
        
    /*    "site.users.permissions.admin"=>array(                   
                    "title"=>"Permissions",
                    "route_ajax"=>array('users_guard_site_ajax'=>array('action'=>'ListPermission')),
                    "help"=>"users permissions administration",
                    "picture"=>"/pictures/icons/access.png",
                    "credentials"=>array(array('superadmin','admin','settings_user_permission')),
                    "enabled"=>true,               
        ), */
        
        "site.users.groups.admin"=>array(                 
                    "title"=>"Permissions groups",
                    "help"=>"users administration",
                    "route_ajax"=>array('users_guard_site_ajax'=>array('action'=>'ListGroup')),
                    "picture"=>"/pictures/icons/groups.png",
                    "credentials"=>array(array('superadmin','settings_user_group')),
                    "enabled"=>true,                         
       ), 
        
        
        /* =============DASHBOARD TAB => MENU ============  */ 
        
         "100_users_configuration"=>array(                   
                     "childs"=>array(
                         "600_users_configuration_groups_admin"=>null,                        
                                    ),                    
                 ),    
        
          "600_users_configuration_groups_admin"=>array(
                    "title"=>"Groups",                  
                    "route_ajax"=>array('users_guard_site_ajax'=>array('action'=>'ListGroup')),                 
                    "credentials"=>array(array('superadmin','admin','settings_user_group')),
                    ),  
        
   ),   
    
  

);