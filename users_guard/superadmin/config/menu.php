<?php

return array(
    
    "menu"=>array(
        "dashboard_home"=>array(                                    
                     "childs"=>array("dashboard_users_groups"=>'','dashboard_users_permissions'=>''),
       ),
    ),
    
    "items"=>array(
      
     
       "dashboard_users_groups"=>array(
                    "component"=>"/users_guard/menuItemGroups",  
                    "title"=>"Groups",
                    "help"=>"users administration",
                    "route_ajax"=>array('users_guard_ajax'=>array('action'=>'DashboardListGroups')),
                    "credentials"=>array(array('superadmin','admin')),
                    "enabled"=>true,                         
       ), 
        
        "dashboard_users_permissions"=>array(
                    "component"=>"/users_guard/menuItemPermissions",  
                    "title"=>"Permissions",
                    "route_ajax"=>array('users_guard_ajax'=>array('action'=>'DashboardListPermission')),
                    "help"=>"users permissions administration",
                    "credentials"=>array(array('superadmin','admin')),
                    "enabled"=>true,                         
       ), 
        
        "site_users"=>array(                           
                     "childs"=>array('site.users.permissions.admin'=>'',"site.users.groups.admin"=>''),                    
                 ),   
        
        "site.users.permissions.admin"=>array(                   
                    "title"=>"Permissions",
                    "route_ajax"=>array('users_guard_site_ajax'=>array('action'=>'ListPermission')),
                    "help"=>"users permissions administration",
                    "picture"=>"/pictures/icons/access.png",
                    "credentials"=>array(array('superadmin','admin')),
                    "enabled"=>true,               
        ), 
        
        "site.users.groups.admin"=>array(                 
                    "title"=>"Groups",
                    "help"=>"users administration",
                    "route_ajax"=>array('users_guard_site_ajax'=>array('action'=>'ListGroup')),
                    "picture"=>"/pictures/icons/groups.png",
                    "credentials"=>array(array('superadmin','admin')),
                    "enabled"=>true,                         
       ), 
   ),
    

);