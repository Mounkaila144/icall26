<?php

return array(

    "menu"=>array(                   
        "site.dashboard"=>array(                                            
            "childs"=>array('site_mutual'=>''),                    
        ),                    
    ),
      
    "items"=>array(   // SITE MENU STRUCTURE 

        "site_mutual"=>array(
            "title"=>"Mutual",                  
            "route_ajax"=>array('site_ajax'=>array('action'=>'Home')),
            "enabled"=>true,
            "childs"=>array("site_mutual.00_mutuals"=>null,
                            "site_mutual.30_settings"=>null,
            ),           
            "credentials"=>array(array('superadmin','admin','app_mutual')),
        ), 


        "site_mutual.00_mutuals"=>array(
            "title"=>"Mutuals",
            "route_ajax"=>array("app_mutual_ajax"=>array("action"=>"ListMutualPartner")),                  
            "picture"=>"/module/app_mutual/pictures/mutual.jpg",
            "help"=>"modify, add and delete status",        
            "credentials"=>array(array('superadmin','admin','app_mutual_settings_mutual_list')),
        ), 

        "site_mutual.30_settings"=>array(
            "title"=>"Settings",
            "route_ajax"=>array("app_mutual_ajax"=>array("action"=>"Settings")),                  
            "picture"=>"/pictures/icons/settings.png",
            "help"=>"modify, add and delete status",  
            "credentials"=>array(array('superadmin','admin','app_mutual_settings')),
        ), 
    ),                    
);