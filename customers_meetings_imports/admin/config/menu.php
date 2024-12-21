<?php

return array(

  
       "items"=>array(   // SITE MENU STRUCTURE 
           
                 "site_meetings"=>array(                  
                   "childs"=>array("customers.meeting.import"=>null
                                  
                                ),                    
              ),     
           
            "customers.meeting.import"=>array(
                             "title"=>"Import meeting",
                            // "component"=>"/customers_meetings/MenuItemType",
                             "route_ajax"=>array("customers_meeting_imports_ajax"=>array("action"=>"ListFiles")),                  
                             "picture"=>"/pictures/icons/import32x32.png",
                             "help"=>"modify, add and delete status",    
                             "credentials"=>array(array('superadmin','admin','settings_meeting_import')), 
                ),     
             
           /* =============DASHBOARD MENU ============  */  
           
            "100_meetings_configuration"=>array(
                   "childs"=>array("300_meetings_configuration_customers_meeting_import"=>null)                
               ),
           
             "300_meetings_configuration_customers_meeting_import"=>array(
                                    "title"=>"Import meeting",                          
                             "route_ajax"=>array("customers_meeting_imports_ajax"=>array("action"=>"ListFiles")),                                             
                             "credentials"=>array(array('superadmin','admin','settings_meeting_import')),  
                ), 
           
            /* =============DASHBOARD3 MENU ============  */
     
            "0020_meetings_configuration"=>array(
                     "childs"=>array("0060_meetings_configuration_customers_meeting_import"=>null)                
                    ),  

             "0060_meetings_configuration_customers_meeting_import"=>array(
                           "title"=>"Import",
                           "icon"=>"fa-file",
                            // "component"=>"/customers_meetings/MenuItemType",
                             "route_ajax"=>array("customers_meeting_imports_ajax"=>array("action"=>"ListFiles")),                  
                             "picture"=>"/pictures/icons/import32x32.png",
                             "help"=>"modify, add and delete status",    
                             "credentials"=>array(array('superadmin','admin','settings_meeting_import')), 
                ),     
     ),
);