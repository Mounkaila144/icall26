<?php

return array(
    
    "dashboard.site"=>array(
             
                "dashboard-customers-meeting"=>array(
                                    "title"=>"Meetings",
                                  //  "route"=>array(""=>array()),
                                    "icon"=>"table",
                                    "route"=>array("customers_meeting_ajax"=>array("action"=>"ListPartialMeeting")),
                                    "help"=>"help download",
                                    "picture"=>"/pictures/icons/meeting.png",  
                                    "credentials"=>array(array('superadmin','admin','meeting_list')),
                                  //  "component"=>"/customers_schedule/tabCustomerMeetingSite",   
                ), 
        
                "dashboard-customers-meeting2"=>array(
                                    "target"=>"dashboard-customers-meeting",
                                    "title"=>"Meetings2",
                                  //  "route"=>array(""=>array()),
                                    "icon"=>"table",
                                    "route"=>array("customers_meeting_ajax"=>array("action"=>"ListPartialMeeting2")),
                                    "help"=>"help download",
                                    "picture"=>"/pictures/icons/meeting.png",  
                                    "credentials"=>array(array('superadminxxx','meeting_list2')),
                                  //  "component"=>"/customers_schedule/tabCustomerMeetingSite",   
                ), 
        
                "dashboard-customers-planning"=>array(
                                    "title"=>"Planning-meeting",
                                    "icon"=>"calendar",
                                    "help"=>"help download",
                                    "picture"=>"/pictures/icons/calendar.png",  
                                    "route"=>array("customers_meeting_ajax"=>array("action"=>"ListPartialMeetingSchedule")),
                                  //  "component"=>"/customers_meetings/tabSchedule",   
                                    "credentials"=>array(array('superadmin','admin','meeting_schedule')),       
                ), 
        
                 "dashboard-customers-planning-range"=>array(
                                    "title"=>"Planning-meeting2",
                                    "icon"=>"calendar",
                                    "help"=>"help download",
                                    "picture"=>"/pictures/icons/calendar.png",  
                                    "route"=>array("customers_meeting_ajax"=>array("action"=>"ListPartialMeetingScheduleRange")),
                                  //  "component"=>"/customers_meetings/tabSchedule",   
                                    "credentials"=>array(array('superadmin','meeting_schedule_range')),       
                ), 
      
             
    ),

     "site.models.variables.email"=>array(
            "10-customer-meeting-variables-email"=>array(
                        "title"=>"Meetings",                      
                        "component"=>"/customers_meetings/variablesEmailTab",     
             )
   ),
    
      "site.models.variables.installation.email"=>array(
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

  
);