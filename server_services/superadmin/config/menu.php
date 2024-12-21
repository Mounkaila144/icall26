<?php

 
return array(
"menu"=>array(
        "dashboard_home"=>array(                                    
                     "childs"=>array("dashboard_master_server_service"=>'',
                                //    "dashboard_server_registration"=>'',
                                ),
       ),
               
      
    ),
    
    "items"=>array(
      
     
       "dashboard_master_server_service"=>array(
                     "component"=>"/server_services/menuItemSettings",   
                    "title"=>"Master Service Settings",
               //     "help"=>"users administration",
                    "route_ajax"=>array('server_services_ajax'=>array('action'=>'Settings')),
                     "credentials"=>array(array('superadmin')),
                    "enabled"=>true,                         
       ), 
       
  /*       "dashboard_server_registration"=>array(
                    "component"=>"/server_services/menuItemRegistration",   
                    "title"=>"Server Registrations",
                 //   "help"=>"users administration",
                    "route_ajax"=>array('server_services_ajax'=>array('action'=>'Registration')),
                    "credentials"=>array(array('superadmin')),
                    "enabled"=>true,                         
       ), */
        
  ),
    
);