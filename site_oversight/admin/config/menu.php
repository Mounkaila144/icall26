<?php

return array(
      
    
    "items"=>array(
          "site_admin"=>array(                   
                     "childs"=>array("site_oversight"=>''),                   
                 ),   
     
     "site_oversight"=>array(
                    "title"=>"Oversight",
                    "route_ajax"=>array("site_oversight_ajax"=>array("action"=>"ListMessage")),                  
                    "picture"=>"/module/site_oversight/pictures/logo.png",                    
                    "credentials"=>array(array('superadmin','settings_site_oversight')),
                   ),  
          /* =============DASHBOARD3 MENU ============  */

            "0010_site_admin_configuration"=>array(                              
                   "childs"=>array( "0100_site_oversight"=>null
                        )
               ), 
     
           "0100_site_oversight"=>array(
                    "title"=>"Oversight",
                    "icon"=>"fa-cog",
                    "route_ajax"=>array("site_oversight_ajax"=>array("action"=>"ListMessage")),                  
                    "picture"=>"/module/site_oversight/pictures/logo.png",                    
                    "credentials"=>array(array('superadmin','settings_site_oversight')),
                   ),  
        
           /*=====================================DASHBOARD===================================*/
        
             "80_site_configuration"=>array(                   
                     "childs"=>array("site_oversight_config"=>''),                   
                 ),   
     
        "site_oversight_config"=>array(
                    "title"=>"Oversight",
                    "route_ajax"=>array("site_oversight_ajax"=>array("action"=>"ListMessage")),                  
                    "picture"=>"/module/site_oversight/pictures/logo.png",                    
                    "credentials"=>array(array('superadmin','settings_site_oversight')),
                   ),  
       
     
  ),
    
);