<?php

return array(
    
   "dashboard-site-customers-meeting-new"=>array(
            "customer-meeting-informations"=>array(
                        "title"=>"Informations",
                      //  "help"=>"help categories",
                      //  "picture"=>"/pictures/icons/category.png",  
                        "component"=>"/customers_meetings_forms/new",     
             ) 
    ),  

    "dashboard-site-customers-meeting-view"=>array(
            "customer-b-informations"=>array(
                        "title"=>"Informations",
                      //  "help"=>"help categories",
                        "picture"=>"/pictures/icons/category.png",  
                        "component"=>"/customers_meetings_forms/view",     
             )
   ),
    
     "site.models.variables.email"=>array(
            "meeting-form-variables-email"=>array(
                        "title"=>"Form",                      
                        "component"=>"/customers_meetings_forms/variablesEmailTab",     
             )
   ),
    
    "site.models.variables.sms"=>array(
            "meeting-form-variables-sms"=>array(
                        "title"=>"Form",                      
                        "component"=>"/customers_meetings_forms/variablesEmailTab",     
             )
   ),

     "site.models.variables.meeting.document"=>array(
            "meeting-form-variables-document"=>array(
                        "title"=>"Form",                      
                        "component"=>"/customers_meetings_forms/variablesEmailTab",     
             )
   ),
    
    
      "site.initialization"=>array(
             
                "10_customers.meetings.forms.initialization"=>array(                                   
                                    "component"=>"/customers_meetings_forms/initialization",   
                ), 
      
    ),
);