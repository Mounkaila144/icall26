<?php

return array(

    
    
      "items"=>array(   // SITE MENU STRUCTURE 
          
           "site_meetings"=>array(               
                   "childs"=>array("customers.meeting.registration"=>null,
                                ),                    
                 ),   
          
                    "customers.meeting.registration"=>array(
                         "title"=>"Keys",
                         "route_ajax"=>array("utils_registration_ajax"=>array("action"=>"ListRegistration")),                  
                         "picture"=>"/pictures/icons/fingerprint32x32.png",
                         "help"=>"modify, add and delete status",      
                         "credentials"=>array(array('superadmin','admin','settings_meeting_registration')),
                    ), 

     ),  
);