<?php

return array(
    
    "menu"=>array(
        "dashboard_home"=>array(                                    
                     "childs"=>array("dashboard_system"=>''),
       ),                   
      
    ),
    
    "items"=>array(
      
     
       "dashboard_system"=>array(
                     "component"=>"/system/menuItemSystem",   
                    "title"=>"System",
                 //   "help"=>"users administration",
                    "route_ajax"=>array('system_ajax'=>array('action'=>'System')),
                    "credentials"=>array(array('superadmin')),
                    "enabled"=>true,                         
       ), 
              
   
  ),
    
 

);