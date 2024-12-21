<?php

return array(
    
 

    "site.models.variables.email"=>array(
            "customer-meeting-variables-email"=>array(
                        "title"=>"Meetings",                      
                        "component"=>"/customers_meetings/variablesEmailTab",     
             )
   ),
    
    "site.models.variables.sms"=>array(
            "customer-meeting-variables-sms"=>array(
                        "title"=>"Meetings",                      
                        "component"=>"/customers_meetings/variablesSmsTab",     
             )
   ),   
    
      "site.initialization"=>array(
             
                "00_customers.meetings.initialization"=>array(                                   
                                    "component"=>"/customers_meetings/initialization",   
                ), 
      
    ),
);