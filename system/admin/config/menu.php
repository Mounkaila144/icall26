<?php

return array(
    
    
 "items"=>array(                  
              
      "site_admin"=>array(                   
                     "childs"=>array("99_system.admin"=>''),                   
                 ),   
     
    "99_system.admin"=>array(
                    "title"=>"Settings",
                  //  "icon_awe"=>"fa-cog",
                    "route_ajax"=>array("system_ajax"=>array("action"=>"Settings")),                  
                    "picture"=>"/pictures/icons/settings.png",
                  // "help"=>"modify, add and delete status", 
                    "credentials"=>array(array('superadmin','admin','settings_system')),
                    "enabled"=>true,      
                    ), 
   ),  
     
 
);