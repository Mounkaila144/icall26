<?php

return array(

      
      
       "items"=>array(   // SITE MENU STRUCTURE 
           
               "site_meetings"=>array(                  
                   "childs"=>array("customers.meeting.import.admin"=>null
                            ),                    
                 ),  
           
             "customers.meeting.import.admin"=>array(
                             "title"=>"Imports from base",
                             "route_ajax"=>array("customers_meeting_imports_ajax"=>array("action"=>"ImportFromSite")),                  
                               "picture"=>"/pictures/icons/import32x32.png",
                             "help"=>"modify, add and delete status",                 
                ), 
  ),
);