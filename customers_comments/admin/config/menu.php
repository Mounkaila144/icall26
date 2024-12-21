<?php

return array(
       
       "items"=>array(   // SITE MENU STRUCTURE                                     
           
             "site_customers"=>array(                                      
                   "childs"=>array(
                                    "customers.comments.settings"=>null,
                                  
                                ),                    
               ), 
           
           
            "site_contracts"=>array(                                       
                   "childs"=>array(
                                    "customers.comments.settings"=>null,
                                  
                                ),                    
               ),
           
           
             "site_meetings"=>array(                                  
                   "childs"=>array(
                                    "customers.comments.settings"=>null,
                                  
                                ),                    
               ),
                       
           
            "customers.comments.settings"=>array(
                         "title"=>"Comments",
                         "route_ajax"=>array("customers_comments_ajax"=>array("action"=>"Settings")),                  
                         "picture"=>"/pictures/icons/comments32x32.png",
                         "help"=>"modify, add and delete status", 
                         "credentials"=>array(array('superadmin','settings_customers_comments')),
                         ),        
  ),
    
    
);