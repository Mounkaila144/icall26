<?php

return array(

    "menu"=>array(                   
                    "site.dashboard"=>array(                                            
                        "childs"=>array('site_customers'=>''),                    
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
                     "childs"=>array("site.customers.union"=>null,"site.customers.admin"=>''),
                    // "childs"=>array("site_admin_site"=>'',"site_info"=>'',"site_company"=>'', ,"site_preferences"=>'', "site_logs"=>'', "site_cache"=>''),
                 ),                 
         
               "site.customers.union"=>array(
                    "title"=>"Union",
                    "route_ajax"=>array("customers_ajax"=>array("action"=>"ListUnion")),                  
                    "picture"=>"/pictures/icons/union32x32.png",
                    "help"=>"modify, add and delete status",  
               ),
         
                "site.customers.admin"=>array(
                    "title"=>"Customers",
                    "route_ajax"=>array("customers_ajax"=>array("action"=>"List")),                  
                    "picture"=>"/pictures/icons/customer.png",
                    "help"=>"modify, add and delete status",  
               ),
     ),  
);