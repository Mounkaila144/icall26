<?php

return array(

       
       "items"=>array(   // SITE MENU STRUCTURE 
           
               "site_meetings"=>array(                  
                   "childs"=>array("customers.meeting.forms"=>null),                    
                 ), 
           
                 "customers.meeting.forms"=>array(
                         "title"=>"Forms",
                         "route_ajax"=>array("customers_meeting_forms_ajax"=>array("action"=>"ListForm")),                  
                         "picture"=>"/pictures/icons/form.png",
                         "help"=>"modify, add and delete status", 
                         "credentials"=>array(array("superadmin","admin","meetings_forms"))
                         ),   
           
         /* =============DASHBOARD MENU ============  */  
           
            "100_meetings_configuration"=>array(
                   "childs"=>array("200_meetings_configuration_customers_meeting_forms"=>null)                
               ),
           
             "200_meetings_configuration_customers_meeting_forms"=>array(
                                    "title"=>"Forms",
                         "route_ajax"=>array("customers_meeting_forms_ajax"=>array("action"=>"ListForm")),                                        
                         "credentials"=>array(array("superadmin","admin","meetings_forms"))      
                ), 
           
            /* =============DASHBOARD3 MENU ============  */
     
            "0020_meetings_configuration"=>array(
                     "childs"=>array("0030_meetings_configuration_customers_meeting_forms"=>null)                
                    ),  

            "0030_meetings_configuration_customers_meeting_forms"=>array(
                     "title"=>"Forms",
                     "icon"=>"fa-folder",
                     "route_ajax"=>array("customers_meeting_forms_ajax"=>array("action"=>"ListForm")),                  
                     "picture"=>"/pictures/icons/form.png",
                     "help"=>"modify, add and delete status", 
                     "credentials"=>array(array("superadmin","admin","meetings_forms"))
                     ),   
  ),
);