<?php




return array(
    
  "menu"=>array(                   
                    "site.dashboard"=>array(                                          
                        "childs"=>array('site_admin'=>'','site_products'=>'','site_customers','site_services'=>''),                     
                    ),
      
       "dashboard_home"=>array(                                    
                     "childs"=>array('dashboard_phpinfo'=>''),
       ),
                       
   ),
    
   "items"=>array(   // SITE MENU STRUCTURE 
                "site_admin"=>array(
                     "title"=>"site administration",
                      "credentials"=>array(array('superadmin')),
                     "route_ajax"=>array('site_ajax'=>array('action'=>'Home')),
                     "icon"=>"/pictures/icons/web.png",
                     "enabled"=>true,
                     "childs"=>array("site_logs"=>null,"site_cache"=>null,"site_admin_init"=>''),                   
                 ),   
                        
                "site_products"=>array(
                     "title"=>"Products Administration",
                      "credentials"=>array(array('superadmin')),
                     "route_ajax"=>array('site_ajax'=>array('action'=>'Home')),
                     "enabled"=>true,
                     "childs"=>array('site.products.admin'=>''),                    
                 ), 
       
                 "site_cache"=>array(
                     "title"=>"Cache",
                       "credentials"=>array(array('superadmin')),
                     "picture"=>"/pictures/icons/cache.png",
                     "route_ajax"=>array('site_ajax'=>array('action'=>'Cache')),
                     "enabled"=>true,                               
                 ), 
       
                "site_logs"=>array(
                     "title"=>"Logs",
                      "credentials"=>array(array('superadmin')),
                     "route_ajax"=>array('site_ajax'=>array('action'=>'ListLog')),
                     "enabled"=>true,
                     "childs"=>array(),                                                        
                     "picture"=>"/pictures/icons/log.png",
                     "help"=>"modify, add and delete status",  
                 ),  
                    
             
       
                 'dashboard_phpinfo'=>array(
                     "title"=>"PHP Info",
                     "route_ajax"=>array('site_ajax'=>array('action'=>'PhpInfo')),
                     "component"=>"/site/menuPhpInfoItem",
                     "enabled"=>true,                                                                        
                     "picture"=>"/pictures/icons/log.png",                    
                      "credentials"=>array(array('superadmin')),
                 ),
              
                  "site_admin_init"=>array(
                    "title"=>"Initialization",
                        "credentials"=>array(array('superadmin')),
                    "route_ajax"=>array("site_ajax"=>array("action"=>"Initialization")),                    
                    "picture"=>"/pictures/icons/settings.png",                           
                    ),  
       
       
                  "site_services"=>array(
                     "title"=>"Services",
                     "route_ajax"=>array('site_ajax'=>array('action'=>'Home')),
                     "enabled"=>true,   
                     "credentials"=>array(array('superadmin')),
                 ), 
   ),    
     
);

