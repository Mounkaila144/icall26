<?php

return array(

    "menu"=>array(                   
                    "site.dashboard"=>array(                                            
                        "childs"=>array('site_customers'=>''),                    
                    ),  
        
                    "Dashboard"=>array(                                            
                            "childs"=>array(
                                "25_customers"=>'',                                         
                        ), 
                    ),
        
                      "Dashboard3"=>array(                                            
                            "childs"=>array('0040_customers'=>null         
                        ), 
                    ),
    ),
    
     "items"=>array(   // SITE MENU STRUCTURE 
               "site_customers"=>array(
                     "title"=>"Customers",
                   //  "url"=>"/site/Admin",
                   //  "urlAjax"=>"/module/site/admin/Home",     
                   //  "icon"=>"/pictures/icons/web.png",
                     "route_ajax"=>array('site_ajax'=>array('action'=>'Home')),
                     "enabled"=>true,
                      "childs"=>array("site.customers.sector"=>null),
                    // "childs"=>array("site_admin_site"=>'',"site_info"=>'',"site_company"=>'', ,"site_preferences"=>'', "site_logs"=>'', "site_cache"=>''),
                 ),              
         
               "site.customers.union"=>array(
                    "title"=>"Union",
                    "route_ajax"=>array("customers_ajax"=>array("action"=>"ListUnion")),                  
                    "picture"=>"/pictures/icons/union32x32.png",
                    "help"=>"modify, add and delete status",  
               ),
         
         
          "site.customers.sector"=>array(
                    "title"=>"Sectors",
                    "route_ajax"=>array("customers_ajax"=>array("action"=>"ListSector")),                  
                    "picture"=>"/pictures/icons/piechart_32x32.png",
                    "help"=>"modify, add and delete status",  
                    "credentials"=>array(array('superadmin','settings_customers_sectors'))
               ),
         
          /* =============DASHBOARD MENU ============  */
            "25_customers"=>array(                  
                   "title"=>"Customers",                                            
                   "enabled"=>true,
                   "component"=>"/customers/DashboardMenuItem", 
                   "childs"=>array("100_customers"=>null,)           
               ), 
         
           "100_customers"=>array(
                   "title"=>"Customers",                                            
                   "enabled"=>true,
                   "route_ajax"=>array("customers_ajax"=>array("action"=>"ListPartial")),     
                   "component"=>"/customers/DashboardCustomerMenuItem",                  
            ), 
         
         
             
        /* =============DASHBOARD3 MENU ============  */

        "0040_customers"=>array(                  
              "title"=>"Customers",  
              "icon"=>"users",
              "enabled"=>true,
              "component"=>"/customers/DashboardMenuItem", 
              "childs"=>array("0000_customers"=>null,)           
          ), 
         
          "0000_customers"=>array(
                    "title"=>"Customers",                                            
                    "enabled"=>true,
                    "route_ajax"=>array("customers_ajax"=>array("action"=>"ListPartial")),     
                    "component"=>"/customers/DashboardCustomerMenuItem",                  
          ), 
           "0150_dashboard_configuration"=>array(                  
                   "childs"=>array(
                       "0050_customers_configuration"=>null, 
                    
                                  )             
           ), 
             "0050_customers_configuration"=>array(
                  "title"=>"Customers",                                            
                   "enabled"=>true,
                   "childs"=>array(                      
                       "0020_site_customers_sector"=>null,
                     )                
               ), 
         
         
            "0020_site_customers_sector"=>array(
                    "title"=>"Sectors",
                    "route_ajax"=>array("customers_ajax"=>array("action"=>"ListSector")),                  
                    "picture"=>"/pictures/icons/piechart_32x32.png",
                    "help"=>"modify, add and delete status",  
                    "credentials"=>array(array('superadmin','settings_customers_sectors'))
               ),
     ),  
);