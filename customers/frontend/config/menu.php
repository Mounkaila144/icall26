<?php

return array(
    
     "menu"=>array(                   
                   
         
                    "customer.dashboard"=>array(
                         
                          "childs"=>array(//"30_customers.account.admin"=>'',
                                      //  "40_customers.account.my-languages.admin"=>''
                                        "20_customers.customers.admin"=>'',
                                ),
                    ),
                       
     ),
       
    
    "items"=>array(
      
             
        /* ================ customer.dashboard ================================= */
    /*    "30_customers.account.admin"=>array(
                     "title"=>"My account",
                   //  "credentials"=>array(array('superadmin','admin','settings_user')),
                     "icon_awe"=>"fa-user",
                     "route_ajax"=>array('customers_ajax'=>array('action'=>'MyAccount')),
                     "childs"=>array(),  
                     "enabled"=>true,                                  
                 ), */
        
        "20_customers.customers.admin"=>array(
                     "title"=>"Customers",
                   //  "credentials"=>array(array('superadmin','admin','settings_user')),
                     "icon_awe"=>"fa-users",
                     "route_ajax"=>array('customers_ajax'=>array('action'=>'ListUserForCompany')),
                     "childs"=>array(),    
                     "credentials"=>array(array('superadmin','admin','customers')),
                     "enabled"=>true,                                  
                 ),
        "40_customers.account.my-languages.admin"=>array(
                     "title"=>"My languages",
                   //  "credentials"=>array(array('superadmin','admin','settings_user')),
                     "icon_awe"=>"fa-language",
                     "route_ajax"=>array('customers_ajax'=>array('action'=>'MyLanguages')),
                     "childs"=>array(),  
                     "enabled"=>true,                                  
                 ),
  ),
    
 
);