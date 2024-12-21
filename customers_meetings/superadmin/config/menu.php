<?php

return array(

       "menu"=>array(                   
                        "site.dashboard"=>array(                                            
                            "childs"=>array('site_meetings'=>''),                    
                        ),                    
       ),
      
       "items"=>array(   // SITE MENU STRUCTURE 
           
                 "site_meetings"=>array(
                   "title"=>"Meetings",                  
                   "route_ajax"=>array('site_ajax'=>array('action'=>'Home')),
                   "enabled"=>true,
                   "childs"=>array("customers.meeting.status"=>null,"customers.meeting.settings"=>null,
                                   "customers.meeting.status_call"=>null,"customers.meeting.status_lead"=>null
                            ),                    
                 ), 
           
                     
     
                "customers.meeting.status"=>array(
                             "title"=>"Meeting Status",
                             "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"ListStatus")),                  
                             "picture"=>"/pictures/icons/status32x32.png",
                             "help"=>"modify, add and delete status",                 
                ), 
           
               "customers.meeting.status_call"=>array(
                             "title"=>"Meeting Status Call",
                             "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"ListStatusCall")),                  
                             "picture"=>"/pictures/icons/status32x32.png",
                             "help"=>"modify, add and delete status",                 
                ), 
           
                 "customers.meeting.settings"=>array(
                         "title"=>"Settings",
                         "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"Settings")),                  
                         "picture"=>"/pictures/icons/settings.png",
                         "help"=>"modify, add and delete status",                 
                         ),   
           
             "customers.meeting.status_lead"=>array(
                             "title"=>"Meeting Status Lead",
                             "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"ListStatusLead")),                  
                             "picture"=>"/pictures/icons/status32x32.png",
                             "help"=>"modify, add and delete status",                 
                ), 
  ),
);