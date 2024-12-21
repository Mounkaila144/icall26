<?php

return array(
    
    "dashboard.site"=>array(
             
               
        
                 "dashboard-customers-meeting-app-domoprime-10-simulations"=>array(
                                    "title"=>"Simulations",                                  
                                    "icon"=>"table",
                                    "route"=>array("app_domoprime_iso_ajax"=>array("action"=>"ListPartialSimulation")),                                  
                                   // "picture"=>"/pictures/icons/meeting.png",  
                                    "credentials"=>array(array('superadmin','admin','app_domoprime_iso_simulation_list')),
                                   
                ),    
        
               
                  "dashboard-customers-meeting-app-domoprime-10-requests"=>array(
                                    "title"=>"Requests",                                  
                                    "icon"=>"table",
                                    "route"=>array("app_domoprime_iso_ajax"=>array("action"=>"ListPartialRequest")),                                  
                                  //  "picture"=>"/pictures/icons/meeting.png",  
                                    "credentials"=>array(array('superadmin','admin','app_domoprime_iso_requests_list')),
                                   
                ),    
        ),
    
    
     "dashboard-site-customers-contract-multiple"=> array(        
             "30-app-domoprime-iso-contract-multiple"=>array(
                        "title"=>"Mutiple", 
                        "component"=>"/app_domoprime_iso/tabMultiple",     
             ),
                 
   ),
    
   "dashboard-site-customers-contract-exports-dictionary"=>array(
            "35-app-domoprime-iso-export-dictionary"=>array(
                        "title"=>"Request",                      
                        "component"=>"/app_domoprime_iso/dictionaryTabInformation",     
             ),                  
   ),
    
    "site.models.variables.contract.document"=>array(
         "customer-variables-document-request"=>array(
                        "title"=>"Request", 
                        "component"=>"/app_domoprime_iso/dictionaryTabVariables",                            
             ),           
   ),
    
    
    "site.models.variables.email"=>array(
        "customer-meeting-variables-domoprime-iso"=>array(
                        "title"=>"Requests",                      
                        "component"=>"/app_domoprime_iso/variablesEmailTab",     
             )
    ),
         
    "dashboard-site-customers-meeting-multiple"=>array(    
        "30-app-domoprime-iso-meeting-multiple"=>array("title"=>"Mutiple", 
                        "component"=>"/app_domoprime_iso/tabMultipleForMeeting",  
            ),
    )
);
