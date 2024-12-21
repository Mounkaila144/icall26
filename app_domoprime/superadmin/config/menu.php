<?php

return array(

    "menu"=>array(                   
                        "site.dashboard"=>array(                                            
                          //  "childs"=>array('site_domoprime'=>''),                    
                        ),                    
       ),
      
       "items"=>array(   // SITE MENU STRUCTURE 
           
                 "site_domoprime"=>array(
                   "title"=>"ISO",                  
                   "route_ajax"=>array('site_ajax'=>array('action'=>'Home')),
                   "enabled"=>true,
                    "childs"=>array("site_domoprime.settings"=>null
                            ),                  
                 ), 
           
           
                  "site_domoprime.settings"=>array(
                             "title"=>"Settings",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"Settings")),                  
                             "picture"=>"/module/app_domoprime/pictures/domoprime32x32.png",
                             "help"=>"modify, add and delete status",                 
                ), 
         ),                    
);