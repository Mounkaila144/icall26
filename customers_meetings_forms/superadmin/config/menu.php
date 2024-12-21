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
                         ),   
  ),
);