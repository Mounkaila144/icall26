<?php

return array(
    
 /*   "dashboard.site"=>array(
             
               "dashboard-site-customers"=>array(
                                    "title"=>"Customers",
                                    "route"=>array("customers_ajax"=>array("action"=>"ListPartial")),
                                    "help"=>"help download",
                                    "picture"=>"/pictures/icons/customer.png",  
                             //       "component"=>"/customers/tabCustomerSite",   
                ), 
      
    ),*/

   "dashboard-site-customers-meeting-view"=>array(
            "customer-map"=>array(
                        "title"=>"localisation",
                      //  "help"=>"help categories",
                        "picture"=>"/pictures/icons/category.png",  
                        "component"=>"/customers/localisation",     
             )
   ),
    
  
   "dashboard-site-customers-contract-view"=>array(
            "customer-map"=>array(
                        "title"=>"localisation",
                      //  "help"=>"help categories",
                        "picture"=>"/pictures/icons/category.png",  
                        "component"=>"/customers/localisation",     
             )
   ),
    
    "site.models.variables.email"=>array(
            "customer-variables-email"=>array(
                        "title"=>"Customer",                      
                        "component"=>"/customers/variablesEmailTab",     
             )
   ),
    
     "site.models.variables.sms"=>array(
            "customer-variables-sms"=>array(
                        "title"=>"Customer",                      
                        "component"=>"/customers/variablesSmsTab",     
             )
   ),
       
);