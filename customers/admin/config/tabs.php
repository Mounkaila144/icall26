<?php

return array(
    
  
    
    "site.models.variables.email"=>array(
            "00-customer-variables-email"=>array(
                        "title"=>"Customer",                      
                        "component"=>"/customers/variablesEmailTab",     
             )
   ),
    
         "site.models.variables.installation.email"=>array(
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
       
   "dashboard.site"=>array(
             
                "dashboard-x-customers"=>array(
                                    "title"=>"Customers",
                                    "icon"=>"users",                                
                                    "route"=>array("customers_ajax"=>array("action"=>"ListPartial")),
                                    "help"=>"help download",
                                    "credentials"=>array(array('superadmin','admin','customers_list')),
                                    "picture"=>"/pictures/icons/contract.png",  
                                  //  "component"=>"/customers_schedule/tabCustomerMeetingSite",   
                ), 
        
          
     ),  
);