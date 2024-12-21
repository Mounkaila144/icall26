<?php


return array(
/*  "items"=>array(   
               "site_admin"=>array("childs"=>array("site_admin_manager"=>'')                
                 ),                   
 // CHILDS     
   "site_admin_manager"=>array(
                     "title"=>"Manager",
                     "route"=>array("site_admin_manager"=>array()),                    
                     "picture"=>"/pictures/icons/website.png",
                     "help"=>"site manager",
                     "credentials"=>array(),
                     "enabled"=>true,                    
                 ),

    ),*/
    
   "menu"=>array(                   
                    "site.dashboard"=>array(                                          
                        "childs"=>array('site_admin'=>'','site_products'=>'','site_customers'=>'','site_communications'=>''),                     
                    ),
                  "Dashboard"=>array(                                            
                            "childs"=>array(
                             
                                "99_configurations"=>''),                    
                        ), 
              
              
                       
   ),
    

    
    "items"=>array(   // SITE MENU STRUCTURE 
                "site_admin"=>array(
                     "title"=>"Site administration",
                     "route_ajax"=>array('site_ajax'=>array('action'=>'Home')),
                     "icon"=>"/pictures/icons/web.png",
                     "enabled"=>true,
                     "childs"=>array("site_logs"=>null,/* "site_cache"=>null */ ),                   
                 ),   
        
                  "site_products"=>array(
                     "title"=>"Products Administration",
                     "route_ajax"=>array('site_ajax'=>array('action'=>'Home')),
                     "enabled"=>true,
                     "childs"=>array('site.products.admin'=>''),                    
                 ), 
        
                "site_cache"=>array(
                     "title"=>"Cache",
                     "picture"=>"/pictures/icons/cache.png",
                     "route_ajax"=>array('site_ajax'=>array('action'=>'Cache')),
                     "enabled"=>true,                               
                 ), 
       
                "site_logs"=>array(
                     "title"=>"Logs",
                     "route_ajax"=>array('site_ajax'=>array('action'=>'ListLog')),
                     "enabled"=>true,
                     "childs"=>array(),                                                        
                     "picture"=>"/pictures/icons/log.png",
                     "help"=>"modify, add and delete status",  
                     "credentials"=>array('superadmin'),
                 ),  
        
        
                  "site_communications"=>array(
                     "title"=>"Communications",
                     "route_ajax"=>array('site_ajax'=>array('action'=>'Home')),
                     "enabled"=>true,
                     "childs"=>array(),                    
                 ), 
       
        
        
         /* =============DASHBOARD TAB => MENU ============  */                      
           
            "90_configuration"=>array(
                   "childs"=>array("80_site_configuration"=>null)                
               ),
        
         "80_site_configuration"=>array(
                   "title"=>"Site",                                            
                   "enabled"=>true,                  
                   "childs"=>array( "80_site_configuration_logs"=>null
                        )
               ), 
        
        
     
      "80_site_configuration_logs"=>array(
                     "title"=>"Logs",
                     "route_ajax"=>array('site_ajax'=>array('action'=>'ListLog')),                    
                     "credentials"=>array('superadmin'),
                     "enabled"=>true,
                           
                 ),    
        
       /* =============DASHBOARD3 ============  */         
        "0080_dashboard_customers_configuration"=>array(                                                 
                  "childs"=>array(
                     "0000_site_admin_configuration"=>null,
                   )
        ), 
        
         "0000_site_admin_configuration"=>array(
                   "title"=>"Site Administration",                                            
                   "enabled"=>true,
                              
               ),  
        
        
        /* ------------------------------------------------------   */
        
         "0150_dashboard_configuration"=>array(
                "childs"=>array(
                    "0010_site_admin_configuration"=>null,
                )                 
           ),
        
        
        "0010_site_admin_configuration"=>array(
                   "title"=>"Site",                                            
                   "enabled"=>true,
                     "childs"=>array( "0070_site_configuration_logs"=>null,
                       "0010_configuration"=>null,
               ),  
        ),
         
     
            "0070_site_configuration_logs"=>array(
                     "title"=>"Logs",
                     "route_ajax"=>array('site_ajax'=>array('action'=>'ListLog')),
                     "enabled"=>true,
                     "childs"=>array(),                                                        
                     "picture"=>"/pictures/icons/log.png",
                     "help"=>"modify, add and delete status",  
                     "credentials"=>array('superadmin'),
                 ),  
        
        
         "99_configurations"=>array(
                   "title"=>"Configurations",                                            
                   "enabled"=>true,
//              "childs"=>array(
//                    "0010_configuration"=>null,
//                ) ,
//             
                 
               ),  
        
      /*   "0010_configuration"=>array(
                   "title"=>"Site",                                            
                   "enabled"=>true,
                        "component"=>"/site/menuDashboard", 
               ), */ 
        ),
         
         
);