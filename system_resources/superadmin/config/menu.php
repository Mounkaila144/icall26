<?php

return array(
    "menu"=>array(                   
        "dashboard_home"=>array(                                            
                        "childs"=>array('dashboard_system.resources.admin'=>''),                    
                    ), 
    ),  
    
 "items"=>array(                  
                 
    "dashboard_system.resources.admin"=>array(
                    "title"=>"Resources",
                    "component"=>"/system_resources/menuItemResources",
                    "route_ajax"=>array("system_resources_ajax"=>array("action"=>"Settings")),                  
                    "picture"=>"/pictures/icons/toolsbox32x32.png",
                   "help"=>"modify, add and delete status", 
                //    "credentials"=>array(array('superadmin','settings_system_resources')),
                    "enabled"=>true,      
                    ), 
   ),  
     
 
);