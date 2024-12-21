<?php

return array(

       "menu"=>array(                   
                        "site.dashboard"=>array(                                            
                            "childs"=>array('site_meetings'=>'','site_meetings_schedule'=>''),                    
                        ),      
           
                          "Dashboard"=>array(                                            
                            "childs"=>array('10_meetings'=>'',
                                          '20_meetings_schedule'=>'',
                                          '30_meeting2'=>''),                    
                        ), 
                                                         
                        "Dashboard3"=>array(                                            
                            "childs"=>array( "0030_meetings"=>null,
                                             "0060_leads_schedules"=>null
                                            ),                               
                        ),
       ),
      
       "items"=>array(   // SITE MENU STRUCTURE 
           
                 "site_meetings"=>array(
                   "title"=>"Meetings",                  
                   "route_ajax"=>array('site_ajax'=>array('action'=>'Home')),
                   "enabled"=>true,
                   "childs"=>array("customers.meeting.status"=>null,"customers.meeting.settings"=>null,"customers.meeting.status_call"=>null,
                                   "customers.meeting.campaign"=>null,"customers.meeting.type"=>null,"customers.meeting.status_lead"=>null,
                                   "customers.meeting.range_date"=>null,
                                   "customers.meeting.company"=>null,  
                                ),                    
                 ),            
           
                 "site_meetings_schedule"=>array(
                   "title"=>"Meetings Schedule",                  
                   "route_ajax"=>array('site_ajax'=>array('action'=>'Home')),
                   "enabled"=>true,                                     
                 ),                                 
     
                "customers.meeting.status"=>array(
                             "title"=>"Meeting Status",
                             "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"ListStatus")),                  
                             "picture"=>"/pictures/icons/status32x32.png",
                             "help"=>"modify, add and delete status",    
                             "credentials"=>array(array('superadmin','admin','settings_meeting_status')), 
                ),   
           
                 "customers.meeting.settings"=>array(
                         "title"=>"Settings meeting",
                         "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"Settings")),                  
                         "picture"=>"/pictures/icons/settings.png",
                         "help"=>"modify, add and delete status",    
                         "credentials"=>array(array('superadmin','admin','settings_meeting_options')), 
                         ),  
           
              "customers.meeting.status_call"=>array(
                             "title"=>"Meeting Status Call",
                             "component"=>"/customers_meetings/MenuItemStatusCall",
                             "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"ListStatusCall")),                  
                             "picture"=>"/pictures/icons/status32x32.png",
                             "help"=>"modify, add and delete status",    
                             "credentials"=>array(array('superadmin','admin','settings_meeting_statuscall')), 
                ),   
           
             "customers.meeting.campaign"=>array(
                             "title"=>"Campaigns of prospecting",
                             "component"=>"/customers_meetings/MenuItemCampaign",
                             "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"ListCampaign")),                  
                             "picture"=>"/pictures/icons/campaign.png",
                             "help"=>"modify, add and delete status",    
                             "credentials"=>array(array('superadmin','admin','settings_meeting_campaign')), 
                ),   
           
            "customers.meeting.type"=>array(
                             "title"=>"Type",
                             "component"=>"/customers_meetings/MenuItemType",
                             "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"ListType")),                  
                             "picture"=>"/pictures/icons/type32x32.png",
                             "help"=>"modify, add and delete status",    
                             "credentials"=>array(array('superadmin','admin','settings_meeting_type')), 
                ),   
           
           
             "customers.meeting.status_lead"=>array(
                             "title"=>"Meeting Status Lead",
                             "component"=>"/customers_meetings/MenuItemStatusLead",
                             "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"ListStatusLead")),                  
                             "picture"=>"/pictures/icons/status32x32.png",
                             "help"=>"modify, add and delete status",    
                             "credentials"=>array(array('superadmin','admin','settings_meeting_status_lead')), 
                ),   
           
              "customers.meeting.range_date"=>array(
                         "title"=>"Range date meetings",
                         "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"ListRange")),                  
                         "picture"=>"/pictures/icons/day-range32x32.png",
                         "help"=>"modify, add and delete status",      
                         "credentials"=>array(array('superadmin','settings_meeting_range_date')),
                         ), 
           
            "customers.meeting.company"=>array(
                    "title"=>"Companies",
                    "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"ListCompany")), 
                    "credentials"=>array(array('superadmin','settings_meeting_company')),
                     "picture"=>"/pictures/icons/company.png",
                    "help"=>"modify, add and delete status",  
               ),
          
            /* =============DASHBOARD MENU ============  */
           
            "10_meetings"=>array(
                   "title"=>"Meetings",                                            
                   "enabled"=>true,
                   "component"=>"/customers_meetings/DashboardMenuItem",
                   "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"ListPartialMeeting")),         
                    "credentials"=>array(array('superadmin','meeting_list')),
               ),  
           
           
            "90_configuration"=>array(
                   "childs"=>array("100_meetings_configuration"=>null)                
               ),  
                                  
           
            "100_meetings_configuration"=>array(
                   "title"=>"Meetings",                                            
                   "enabled"=>true,
                   "component"=>"/customers_meetings/DashboardConfigurationMenuItem" ,
                     "childs"=>array("100_customers_meeting_range_date"=>null,
                                     "200_customers_meeting_status_lead"=>null,
                                     "300_customers_meeting_type"=>null,
                                     "400_customers_meeting_campaign"=>null,
                                     "500_customers_meeting_status_call"=>null,
                                     "600_customers_meeting_status"=>null,
                                     "900_meetings_configuration_settings"=>null,
                                     "1000_customers_meeting_company"=>null, 
                        ),
                 "credentials"=>array(array('menu_configuration_admin','superadmin')),
                       
               ), 
           
              "100_customers_meeting_range_date"=>array(
                         "title"=>"Range date",     
                         // "component"=>"/customers_meetings/DashboardConfigurationRangeDateMenuItem" ,    
                         "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"ListRange")),                                          
                         "credentials"=>array(array('superadmin','settings_meeting_range_date')),
                         ), 
           
               "200_customers_meeting_status_lead"=>array(
                         "title"=>"Status Lead",                          
                         "credentials"=>array(array('superadmin','admin','settings_meeting_status_lead')),                          
                         "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"ListStatusLead")),                                                  
                        // "component"=>"/customers_meetings/DashboardConfigurationStatusLeadMenuItem" ,                             
                         ),
           
              "300_customers_meeting_type"=>array(
                             "title"=>"Type",
                              "component"=>"/customers_meetings/DashboardConfigurationTypeMenuItem" ,       
                             "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"ListType")), 
                             "credentials"=>array(array('superadmin','admin','settings_meeting_type')), 
                ),   
           
              "400_customers_meeting_campaign"=>array(
                             "title"=>"Campaigns",   
                             "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"ListCampaign")),   
                             "component"=>"/customers_meetings/DashboardConfigurationCampaignMenuItem" ,       
                             "credentials"=>array(array('superadmin','admin','settings_meeting_campaign')), 
                ),  
           
              "500_customers_meeting_status_call"=>array(
                             "title"=>"Meeting Status Call",
                            "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"ListStatusCall")), 
                              "component"=>"/customers_meetings/DashboardConfigurationStatusCallMenuItem" ,       
                             "credentials"=>array(array('superadmin','admin','settings_meeting_statuscall')), 
                ),   
           
              "600_customers_meeting_status"=>array(
                             "title"=>"Meeting Status",  
                             "component"=>"/customers_meetings/DashboardConfigurationStatusMenuItem" ,    
                            "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"ListStatus")),   
                             "credentials"=>array(array('superadmin','admin','settings_meeting_status')), 
                ),   
           
               "900_meetings_configuration_settings"=>array(
                         "title"=>"Settings",     
                        "component"=>"/customers_meetings/DashboardConfigurationSettingsMenuItem" ,  
                        "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"Settings")),         
                         "credentials"=>array(array('superadmin','admin','settings_meeting_options')),
                         ),   
           
            "1000_customers_meeting_company"=>array(
                    "title"=>"Companies",
                    "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"ListCompany")), 
                    "credentials"=>array(array('superadmin','settings_meeting_company')),
               ),
           
           /* ======================================================================================== */
            
                      
            "30_schedules"=>array(
                   "childs"=>array("000_meetings_schedule"=>null,
                              //      "050_meetings_schedule_range"=>null
                                    )           
               ),  
           
              "000_meetings_schedule"=>array(
                   "title"=>"Meetings",                                            
                   "enabled"=>true,
                   "component"=>"/customers_meetings/DashboardScheduleMenuItem",
                   "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"ListPartialMeetingSchedule")),         
                  "credentials"=>array(array('menu_onglet_planningrdv','superadmin')),
               ),  
           
               "050_meetings_schedule_range"=>array(
                                    "title"=>"RDV Schedule/Range",                                  
                                    "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"ListPartialMeetingScheduleRange")),                                  
                                     "credentials"=>array(array('superadmin','meeting_schedule_range')),   
                ), 
           
       /* =============DASHBOARD3 MENU ============  */
           
            "0030_meetings"=>array(
                   "title"=>"Meetings",  
                   "icon"=>"fa-calendar",
                   "enabled"=>true,
                   "component"=>"/customers_meetings/DashboardMenuItem"                 
               ),  
           
         
            "0060_leads_schedules"=>array(
                   "title"=>"RDV Planning",     
                   "icon"=>"fa-tasks",
                   "enabled"=>true,
                   "childs"=>array("0000_meetings_schedule"=>null,
                                   "0010_meetings_schedule_range"=>null
                                    )           
               ),  
           
           
             "0000_meetings_schedule"=>array(
                   "title"=>"Meetings", 
                   "icon"=>"fa-list", 
                   "enabled"=>true,
                   "component"=>"/customers_meetings/DashboardScheduleMenuItem"                 
               ),  
           
              "0010_meetings_schedule_range"=>array(
                                    "title"=>"RDV Schedule/Range",
                                     "icon"=>"fa-calendar", 
                                    "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"ListPartialMeetingScheduleRange")),                                  
                                    "credentials"=>array(array('superadmin','meeting_schedule_range')),       
               ), 
                 "0080_dashboard_customers_configuration"=>array(
                   "childs"=>array("0020_meetings_configuration"=>null)                
               ),  
           
              "0020_meetings_configuration"=>array(
                   "title"=>"Meetings", 
                   "icon"=>"fa-list", 
                   "childs"=>array(
                       "0040_customers_meeting_type"=>null,
                       "0070_customers_meeting_campaign"=>null,
                       "0100_customers_meeting_status_call"=>null,
                       "0110_customers_meeting_status"=>null,
                       "0120_meetings_configuration_settings"=>null)                
               ), 
           
           
               "0040_customers_meeting_type"=>array(
                       "title"=>"Type",
                       "icon"=>"fa-list",
                       "component"=>"/customers_meetings/MenuItemType",
                       "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"ListType")),                  
                       "picture"=>"/pictures/icons/type32x32.png",
                       "help"=>"modify, add and delete status",    
                       "credentials"=>array(array('superadmin','admin','settings_meeting_type')), 
                ),   
           
              "0070_customers_meeting_campaign"=>array(
                             "title"=>"Campaigns",
                            "icon"=>"fa-users",
                             "component"=>"/customers_meetings/MenuItemCampaign",
                             "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"ListCampaign")),                  
                             "picture"=>"/pictures/icons/campaign.png",
                             "help"=>"modify, add and delete status",    
                             "credentials"=>array(array('superadmin','admin','settings_meeting_campaign')), 
                ),   
           
               "0100_customers_meeting_status_call"=>array(
                             "title"=>"Meeting Status Call",
                             "icon"=>"fa-phone",
                             "component"=>"/customers_meetings/MenuItemStatusCall",
                             "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"ListStatusCall")),                  
                             "picture"=>"/pictures/icons/status32x32.png",
                             "help"=>"modify, add and delete status",    
                             "credentials"=>array(array('superadmin','admin','settings_meeting_statuscall')), 
                ),   
           
           
           
           
              "0110_customers_meeting_status"=>array(
                             "title"=>"Meeting Status",
                             "icon"=>"fa-cog",
                             "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"ListStatus")),                  
                             "picture"=>"/pictures/icons/status32x32.png",
                             "help"=>"modify, add and delete status",    
                             "credentials"=>array(array('superadmin','admin','settings_meeting_status')), 
                ),   
           
           
              "0120_meetings_configuration_settings "=>array(
                      "title"=>"Settings",
                         "icon"=>"fa-cog",
                         "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"Settings")),                  
                         "picture"=>"/pictures/icons/settings.png",
                         "help"=>"modify, add and delete status",    
                         "credentials"=>array(array('superadmin','admin','settings_meeting_options')), 
                        
               ),  
           
             "0150_dashboard_configuration"=>array(                  
                   "childs"=>array(
                       "0120_meetings_configuration"=>null, 
                    
                                  )             
           ), 
             "0120_meetings_configuration"=>array(  
                   "title"=>"Leads", 
                   "icon"=>"fa-calendar",
                   "enabled"=>true,                    
                   "childs"=>array(
                      "0000_customers_meeting_range_date"=>null,
                      "0010_customers_meeting_status_lead"=>null
                   
                  
                   )
            ),
           
           
              "0000_customers_meeting_range_date"=>array(
                         "title"=>"Range date",
                         "icon"=>"fa-calendar",
                         "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"ListRange")),                  
                         "picture"=>"/pictures/icons/day-range32x32.png",
                         "help"=>"modify, add and delete status",      
                         "credentials"=>array(array('superadmin','settings_meeting_range_date')),
                         ), 
           
           "0010_customers_meeting_status_lead"=>array(
                             "title"=>"Meeting Status Lead",
                             "icon"=>"fa-cog",
                             "component"=>"/customers_meetings/MenuItemStatusLead",
                             "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"ListStatusLead")),                  
                             "picture"=>"/pictures/icons/status32x32.png",
                             "help"=>"modify, add and delete status",    
                             "credentials"=>array(array('superadmin','admin','settings_meeting_status_lead')), 
                ),   
           
           
           
            "20_meetings_schedule"=>array(
                            "title"=>"RDV Schedule/Range",                                  
                            "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"ListPartialMeetingScheduleRange")),                                  
                             "credentials"=>array(array('superadmin','meeting_schedule_range')),   
                ), 
           
           
           "30_meeting2"=>array( 
                            "title"=>"Meetings2",
                            "route_ajax"=>array("customers_meeting_ajax"=>array("action"=>"ListPartialMeeting2")),
                            "credentials"=>array(array('superadminxxx','meeting_list2')),
                          //  "component"=>"/customers_schedule/tabCustomerMeetingSite",   
                ), 
  ),
);