<?php

return array(
    
    
 "items"=>array(                  
              
      "site_admin"=>array(                   
                     "childs"=>array("98_system.resources.admin"=>''),                   
                 ),   
     
    "98_system.resources.admin"=>array(
                    "title"=>"Resources",
                  //  "icon_awe"=>"fa-cog",
                    "route_ajax"=>array("system_resources_ajax"=>array("action"=>"Settings")),                  
                    "picture"=>"/pictures/icons/toolsbox32x32.png",
                  // "help"=>"modify, add and delete status", 
                    "credentials"=>array(array('superadmin','settings_system_resources')),
                    "enabled"=>true,      
                    ), 
     
     
      /* =============DASHBOARD TAB => MENU ============  */      
     
      "80_site_configuration"=>array(                              
                   "childs"=>array( "00_site_configuration_ressources"=>null,
                                    "10_site_configuration_motors"=>null
                        )
               ), 
     
      "00_site_configuration_ressources"=>array(
                     "title"=>"Resources",
                     "route_ajax"=>array("system_resources_ajax"=>array("action"=>"Settings")),  
                     "credentials"=>array(array('superadmin','settings_system_resources')),
                     "enabled"=>true,
                           
                 ), 
     
     
   ),  
     
 
    
    
    
);