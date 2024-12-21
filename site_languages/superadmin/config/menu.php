<?php

return array(
  "menu"=>array(
        "dashboard_home"=>array(                                    
                     "childs"=>array("dashboard_languages"=>null),
       ),
    ),
    
 "items"=>array(
      
     
       "dashboard_languages"=>array(
                   /* "title"=>"languages",                  
                    "route"=>array(),
                    "route_ajax"=>array(),
                    "picture"=>"/pictures/icons/languages.png",*/
                    "component"=>"/site_languages/menuItem",
                    "help"=>"languages",
                    "credentials"=>array(),
                    "enabled"=>true,                
       ), 
              
      "site_admin"=>array(                   
                     "childs"=>array("site_languages"=>''),
                    // "childs"=>array("site_admin_site"=>'',"site_info"=>'',"site_company"=>'', ,"site_preferences"=>'', "site_logs"=>'', "site_cache"=>''),
                 ),   
     
       "site_languages"=>array(
                    "title"=>"languages",
                    "route_ajax"=>array("languages_site_ajax"=>array("action"=>"List")),                  
                    "picture"=>"/pictures/icons/languages.png",
                    "help"=>"modify, add and delete site languages",                 
                    ),   
  ),
 
);