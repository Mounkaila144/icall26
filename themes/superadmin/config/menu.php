<?php

return array(
    
  "menu"=>array(
        "dashboard_home"=>array(                                    
                     "childs"=>array("dashboard_themes"=>''),
       ),
                
    ),
    
  "items"=>array(   
           
        
        "dashboard_themes"=>array(               
                    "component"=>"/themes/menuItem",   
                    "title"=>"Themes",                  
                    "route_ajax"=>array('themes_ajax_theme'=>array('action'=>'List')),
                    "credentials"=>array(array('superadmin','admin')),
                    "enabled"=>true, 
                    ), 
          
      
   ),   
      
);