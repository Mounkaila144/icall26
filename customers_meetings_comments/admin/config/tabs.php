<?php

return array(
    
  /*  "dashboard.site"=>array(
             
                "dashboard-site-customers-meeting"=>array(
                                    "title"=>"Meetings",
                                  //  "route"=>array(""=>array()),
                                    "route"=>array("customers_meeting_ajax"=>array("action"=>"ListPartialMeeting")),
                                    "help"=>"help download",
                                    "picture"=>"/pictures/icons/meeting.png",  
                                  //  "component"=>"/customers_schedule/tabCustomerMeetingSite",   
                ), 
        
                "dashboard-site-customers-planning"=>array(
                                    "title"=>"Planning",
                                    "help"=>"help download",
                                    "picture"=>"/pictures/icons/calendar.png",  
                                    "component"=>"/customers_schedule/tabCustomerPlanningSite",   
                ), 
      
             
    ),*/

    "dashboard-site-customers-meeting-view"=>array(
           "customer-meeting-comments"=>array(
                        "title"=>"Comments",
                      //  "help"=>"help categories",
                      //  "picture"=>"/pictures/icons/category.png",  
                        "component"=>"/customers_meetings_comments/list",  
                        "credentials"=>array(array('superadmin','admin','meeting_comments_list'))
             ),
        
             "customer-meeting-log-comments"=>array(
                        "title"=>"Logs",
                      //  "help"=>"help categories",
                      //  "picture"=>"/pictures/icons/category.png",  
                        "component"=>"/customers_meetings_comments/listLog",  
                        "credentials"=>array(array('superadmin','admin','meeting_comments_list_log'))
             ) 
    ),  
    
     
);