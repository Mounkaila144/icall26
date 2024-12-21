<?php

return array(
    
    "menu"=>array(
      
        "site.dashboard"=>array(                                            
                        "childs"=>array('site_users'=>''),                    
                    ),  
    ),
    
    "items"=>array(
      
     
        "site_contracts"=>array(
              "childs"=>array('site.attributions.admin'=>'')
            
        ),
        
        "site_users"=>array(
                     "title"=>"Users",
                     "credentials"=>array(array('superadmin','admin','settings_user')),
                     "route_ajax"=>array('site_ajax'=>array('action'=>'Home')),
                     "enabled"=>true,
                     "childs"=>array('site.a.users.admin'=>'','site.functions.admin'=>'',"site.users.team.admin"=>'',
                                    // 'site.attributions.admin'=>''
                                    "site.users.callcenter.admin"=>'',
                                    "site.users.profiles.admin"=>'',
                                    "site.user.settings.admin"=>"",
                                    "site.user.settings.validation"=>"",
                                    "site.user.settings.validation.tokens"=>""
                                    ),                    
                 ),   
        
        "site.a.users.admin"=>array(
                    "title"=>"Conf users",
                    "route_ajax"=>array("users_ajax"=>array("action"=>"List")),                  
                    "picture"=>"/pictures/icons/users.png",
                    "help"=>"modify, add and delete users",  
                     "credentials"=>array(array('superadmin','admin','settings_user_list')),
                    ),  
                 
         "site.users.profiles.admin"=>array(
                    "title"=>"Profiles",
                    "route_ajax"=>array("users_ajax"=>array("action"=>"ListProfile")),                  
                    "picture"=>"/pictures/icons/users.png",
                    "help"=>"modify, add and delete users",  
                     "credentials"=>array(array('superadmin','admin','settings_user_profile_list')),
                    ),
        
         "site.functions.admin"=>array(
                    "title"=>"Functions",
                    "route_ajax"=>array("users_ajax"=>array("action"=>"ListFunction")),                  
                    "picture"=>"/pictures/icons/position.png",
                    "help"=>"modify, add and delete function for users",  
                    "credentials"=>array(array('superadmin','admin','settings_user_function')),
                    ),  
        
        "site.attributions.admin"=>array(
                    "title"=>"Attributions state user payment",
                    "route_ajax"=>array("users_ajax"=>array("action"=>"ListAttribution")),                  
                    "picture"=>"/pictures/icons/salary32x32.png",
                    "help"=>"modify, add and delete function for users",   
                    "credentials"=>array(array('superadmin','admin','settings_user_attribution')),
                    ),  
        
         "site.users.team.admin"=>array(
                    "title"=>"Teams/Control/Call",
                    "route_ajax"=>array("users_ajax"=>array("action"=>"ListTeam")),                  
                    "picture"=>"/pictures/icons/team32x32.png",
                    "help"=>"modify, add and delete function for users",    
                    "credentials"=>array(array('superadmin','admin','settings_user_team')),
                    ), 
        
          "site.users.callcenter.admin"=>array(
                    "title"=>"Call centers",
              
                    "route_ajax"=>array("users_ajax"=>array("action"=>"ListCallcenter")),                  
                    "picture"=>"/pictures/icons/callcenter32x32.png",
                    "help"=>"modify, add and delete function for users",    
                    "credentials"=>array(array('superadmin','admin','settings_user_callcenter')),
                    ), 
        
         "site.user.settings.admin"=>array(
                         "title"=>"Settings by default",
                         "route_ajax"=>array("users_ajax"=>array("action"=>"Settings")),                  
                         "picture"=>"/pictures/icons/settings.png",
                         "help"=>"modify, add and delete status",    
                         "credentials"=>array(array('superadmin','admin','settings_user_settings')),             
                         ), 
        
          "site.user.settings.validation.tokens"=>array(
                    "title"=>"Tokens",
                    "route_ajax"=>array("users_ajax"=>array("action"=>"ListToken")), 
                    "credentials"=>array(array('superadmin','superadmin_settings_contract_validation_token')),
                    "picture"=>"/pictures/icons/token32x32.png",
                  
               ),
        
          "site.user.settings.validation"=>array(
                    "title"=>"Admin export email",
                    "route_ajax"=>array("users_ajax"=>array("action"=>"ValidationSettings")), 
                    "credentials"=>array(array('superadmin','superadmin_settings_contract_validation')),
                    "picture"=>"/pictures/icons/validation32x32.png",
                  
               ),
       /* =============DASHBOARD TAB => MENU ============  */  
         "00_contracts_configuration"=>array(                  
                   "childs"=>array("180_contracts_configuration_attribution"=>null,
                        )
               ), 
           
       
           "180_contracts_configuration_attribution"=>array(
                                                                                         
                   "component"=>"/users/DashboardConfigurationAttributionMenuItem"      ,
                    "title"=>"Attributions",                    
                    "credentials"=>array(array('superadmin','admin','settings_user_attribution')),          
               ), 
        
        
        
              "90_configuration"=>array(
                    "childs"=>array("0100_users_configuration"=>null)            
               ), 
               
        
         "0100_users_configuration"=>array(
                     "title"=>"Users",
                     "credentials"=>array(array('superadmin','admin','settings_user')),                   
                     "enabled"=>true,
                     "childs"=>array(
                         "0100_users_configuration_users_admin"=>null,
                         "0200_users_configuration_functions_admin"=>null,
                         "300_users_configuration_attributions_admin"=>null,
                         "400_users_configuration_teams_admin"=>null,
                         "500_users_configuration_callcenters_admin"=>null,
                         "0900_users_configuration_settings_admin"=>null,
                                    ),
                 "credentials"=>array(array('menu_configuration_admin','superadmin')),
                 ),   
        
        
        "0100_users_configuration_users_admin"=>array(
                    "title"=>"Accounts",                   
                    "route_ajax"=>array("users_ajax"=>array("action"=>"List")),                                       
                     "credentials"=>array(array('superadmin','admin','settings_user_list')),
                    ),  
        
         "0200_users_configuration_functions_admin"=>array(
                    "title"=>"Functions",
                    "route_ajax"=>array("users_ajax"=>array("action"=>"ListFunction")),                                      
                    "credentials"=>array(array('superadmin','admin','settings_user_function')),
                    ),  
        
        "300_users_configuration_attributions_admin"=>array(
                    "title"=>"Attributions",
                    "route_ajax"=>array("users_ajax"=>array("action"=>"ListAttribution")),                                   
                    "credentials"=>array(array('superadmin','admin','settings_user_attribution')),
                    ),  
        
         "400_users_configuration_teams_admin"=>array(
                    "title"=>"Teams",
                    "route_ajax"=>array("users_ajax"=>array("action"=>"ListTeam")),                                     
                    "credentials"=>array(array('superadmin','admin','settings_user_team')),
                    ), 
        
          "500_users_configuration_callcenters_admin"=>array(
                    "title"=>"Call centers",              
                    "route_ajax"=>array("users_ajax"=>array("action"=>"ListCallcenter")),                                     
                    "credentials"=>array(array('superadmin','admin','settings_user_callcenter')),
                    ), 
        
         "0900_users_configuration_settings_admin"=>array(
                         "title"=>"Settings",
                         "route_ajax"=>array("users_ajax"=>array("action"=>"Settings")),                                        
                         "credentials"=>array(array('superadmin','admin','settings_user_settings')),             
                         ), 
        
       
          /* =============DASHBOARD3 MENU ============  */
          "0080_dashboard_customers_configuration"=>array(                                                       
                  "childs"=>array(
                      "0010_users_configuration"=>null,                     
                   )
                   
               ),  
         "0010_users_configuration"=>array(
                     "title"=>"Users",
                     "icon"=>"fa-users",
                     "credentials"=>array(array('superadmin','admin','settings_user')),                   
                     "enabled"=>true,
                     "childs"=>array(
                         "0000_users_configuration_users_admin"=>null,
                         "0010_users_configuration_teams_admin"=>null,
                         "0020_users_configuration_callcenters_admin"=>null,
                         "0030_users_configuration_communication_email_admin"=>null,
                         "0040_users_configuration_communication_sms_admin"=>null,
                         "0050_site_users_tasks_team_admin"=>null,
                         "0060_site_users_messages_list_admin"=>null,
                                    ),                    
                 ),   
        
        
        "0000_users_configuration_users_admin"=>array(
                    "title"=>"Employees",
                     "icon"=>"fa-users",
                    "route_ajax"=>array("users_ajax"=>array("action"=>"List")),                  
                    "picture"=>"/pictures/icons/users.png",
                    "help"=>"modify, add and delete users",  
                     "credentials"=>array(array('superadmin','admin','settings_user_list')),
                    ),  
        
        
        "0010_users_configuration_teams_admin"=>array(
               "title"=>"Teams",
               "icon"=>"fa-users",
               "route_ajax"=>array("users_ajax"=>array("action"=>"ListTeam")),                                     
               "credentials"=>array(array('superadmin','admin','settings_user_team')),
               ), 
        
        "0020_users_configuration_callcenters_admin"=>array(
                "title"=>"Call centers", 
                "icon"=>"fa-users",
                "route_ajax"=>array("users_ajax"=>array("action"=>"ListCallcenter")),                                     
                "credentials"=>array(array('superadmin','admin','settings_user_callcenter')),
                ), 

         "0030_customers_contracts_configuration"=>array(
                   "childs"=>array(
                       "0060_site_attributions_admin"=>null,
                     )                
               ), 
           
        "0060_site_attributions_admin"=>array(
                    "title"=>"Attributions state user payment",
                    "icon"=>"fa-cog",
                    "route_ajax"=>array("users_ajax"=>array("action"=>"ListAttribution")),                  
                    "picture"=>"/pictures/icons/salary32x32.png",
                    "help"=>"modify, add and delete function for users",   
                    "credentials"=>array(array('superadmin','admin','settings_user_attribution')),
                    ),  
        
        
        
         "200_users_configuration_functions_admin"=>array(
                    "title"=>"Functions",
                    "icon"=>"fa-users",
                    "route_ajax"=>array("users_ajax"=>array("action"=>"ListFunction")),                                      
                    "credentials"=>array(array('superadmin','admin','settings_user_function')),
                    ),  
        
        "300_users_configuration_attributions_admin"=>array(
                    "title"=>"Attributions",
                    "route_ajax"=>array("users_ajax"=>array("action"=>"ListAttribution")),                                   
                    "credentials"=>array(array('superadmin','admin','settings_user_attribution')),
                    ),  
        
    
        
          "500_users_configuration_callcenters_admin"=>array(
                    "title"=>"Call centers", 
                     "icon"=>"fa-users",
                    "route_ajax"=>array("users_ajax"=>array("action"=>"ListCallcenter")),                                     
                    "credentials"=>array(array('superadmin','admin','settings_user_callcenter')),
                    ), 
        
         "900_users_configuration_settings_admin"=>array(
                         "title"=>"Settings",
                         "route_ajax"=>array("users_ajax"=>array("action"=>"Settings")),                                        
                         "credentials"=>array(array('superadmin','admin','settings_user_settings')),             
                         ), 
        
         /* =============DASHBOARD3 MENU ============  */
        
          "0040_customers_contracts_configuration"=>array(                              
                   "childs"=>array( "0150_site_attributions_admin"=>null
                        )
               ), 
           
      
          "0150_site_attributions_admin"=>array(
                    "title"=>"Attributions state user payment",
                     "icon"=>"fa-user",
                    "route_ajax"=>array("users_ajax"=>array("action"=>"ListAttribution")),                  
                    "picture"=>"/pictures/icons/salary32x32.png",
                    "help"=>"modify, add and delete function for users",   
                    "credentials"=>array(array('superadmin','admin','settings_user_attribution')),
                    ),          
        
           "0150_dashboard_configuration"=>array(                  
                   "childs"=>array(
                       "0190_users_configuration"=>null, 
                    
                                  )             
           ), 
          "0190_users_configuration"=>array(    
                  "title"=>"Users",                                            
                   "enabled"=>true,
                   "childs"=>array( 
                       "0000_users_configuration_functions_admin"=>null,
                       "0010_users_configuration_attributions_admin"=>null,
                       "0030_users_configuration_settings_admin"=>null,
                       "0080_users_configuration_users_admin"=>null,
                       "0090_users_configuration_teams_admin"=>null,
                       "0100_users_configuration_callcenters_admin"=>null
                        )
               ), 
        
         "0000_users_configuration_functions_admin"=>array(
                    "title"=>"Functions",
                     "icon"=>"fa-users",
                    "route_ajax"=>array("users_ajax"=>array("action"=>"ListFunction")),                  
                    "picture"=>"/pictures/icons/position.png",
                    "help"=>"modify, add and delete function for users",  
                    "credentials"=>array(array('superadmin','admin','settings_user_function')),
                    ),  
        
        "0010_users_configuration_attributions_admin"=>array(
                    "title"=>"Attributions state user payment",
                    "icon"=>"fa-users",
                    "route_ajax"=>array("users_ajax"=>array("action"=>"ListAttribution")),                  
                    "picture"=>"/pictures/icons/salary32x32.png",
                    "help"=>"modify, add and delete function for users",   
                    "credentials"=>array(array('superadmin','admin','settings_user_attribution')),
                    ),  
        
        "0030_users_configuration_settings_admin"=>array(
                         "title"=>"Settings",
                         "icon"=>"fa-cog",
                         "route_ajax"=>array("users_ajax"=>array("action"=>"Settings")),                  
                         "picture"=>"/pictures/icons/settings.png",
                         "help"=>"modify, add and delete status",    
                         "credentials"=>array(array('superadmin','admin','settings_user_settings')),             
                         ), 
        
         "0080_users_configuration_users_admin"=>array(
                    "title"=>"Employees",
                    "icon"=>"fa-users",
                    "route_ajax"=>array("users_ajax"=>array("action"=>"List")),                  
                    "picture"=>"/pictures/icons/users.png",
                    "help"=>"modify, add and delete users",  
                     "credentials"=>array(array('superadmin','admin','settings_user_list')),
                    ),  
        
          "0090_users_configuration_teams_admin"=>array(
                    "title"=>"Teams",
                   "icon"=>"fa-users",
                    "route_ajax"=>array("users_ajax"=>array("action"=>"ListTeam")),                  
                    "picture"=>"/pictures/icons/team32x32.png",
                    "help"=>"modify, add and delete function for users",    
                    "credentials"=>array(array('superadmin','admin','settings_user_team')),
                    ), 
        
         "0100_users_configuration_callcenters_admin"=>array(
                    "title"=>"Call centers",
                   "icon"=>"fa-phone",
                    "route_ajax"=>array("users_ajax"=>array("action"=>"ListCallcenter")),                  
                    "picture"=>"/pictures/icons/callcenter32x32.png",
                    "help"=>"modify, add and delete function for users",    
                    "credentials"=>array(array('superadmin','admin','settings_user_callcenter')),
                    ),  
        
        
        
            
                /* =============DASHBOARD  => MENU ============  */  

                   "0100_users_configuration"=>array(                   
                               "childs"=>array(
                                   "000_users_profils"=>null,
                                   "040_users_teams"=>null,
                                   "070_users_callcenter"=>null,
                                   "080_users_validation_tokens"=>null,
                                   "090_users_validation"=>null,
                                   "100_users_settings"=>null,
                                   "110_users_functions"=>null,
                                   "120_users_list"=>null,
                                              ),                    
                           ), 
                  "000_users_profils"=>array(
                         "title"=>"Profiles",
                         "route_ajax"=>array("users_ajax"=>array("action"=>"ListProfile")),                  
                         "credentials"=>array(array('superadmin','admin','settings_user_profile_list')),

                 ), 
        
                "040_users_teams"=>array(
                        "title"=>"Teams/Control/Call",
                        "route_ajax"=>array("users_ajax"=>array("action"=>"ListTeam")),                    
                        "credentials"=>array(array('superadmin','admin','settings_user_team')),

                 ), 
        
        
                "070_users_callcenter"=>array(
                      "title"=>"Call centers",            
                        "route_ajax"=>array("users_ajax"=>array("action"=>"ListCallcenter")),                  
                        "credentials"=>array(array('superadmin','admin','settings_user_callcenter')),
                    ), 
        
                 "080_users_validation_tokens"=>array(
                        "title"=>"Tokens",
                        "route_ajax"=>array("users_ajax"=>array("action"=>"ListToken")), 
                        "credentials"=>array(array('superadmin','superadmin_settings_contract_validation_token')),

                 ), 
        
                "090_users_validation"=>array(
                        "title"=>"Admin export email",
                        "route_ajax"=>array("users_ajax"=>array("action"=>"ValidationSettings")), 
                        "credentials"=>array(array('superadmin','superadmin_settings_contract_validation')),
                     ), 
             
               "110_users_functions"=>array(
                    "title"=>"Functions",
                    "route_ajax"=>array("users_ajax"=>array("action"=>"ListFunction")),                  
                    "credentials"=>array(array('superadmin','admin','settings_user_function')),
                    ),  
        
                   "100_users_settings"=>array(
                         "title"=>"Settings",
                         "route_ajax"=>array("users_ajax"=>array("action"=>"Settings")),                  
                         "credentials"=>array(array('superadmin','admin','settings_user_settings')),             
                         ), 
        
                 "120_users_list"=>array(
                       "title"=>"Employees",
                       "route_ajax"=>array("users_ajax"=>array("action"=>"List")),                   
                        "credentials"=>array(array('superadmin','admin','settings_user_list','menu_configuration_utilisateur')),
                       ),  
        
        
        
                "50_contract_config"=>array(   
                           "childs"=>array(
                               "0130_users_attributions"=>null,

                               )                
                       ),


                  "0130_users_attributions"=>array(
                    "title"=>"Attributions",
                    "route_ajax"=>array("users_ajax"=>array("action"=>"ListAttribution")),                                   
                    "credentials"=>array(array('superadmin','admin','settings_user_attribution')),
                    ),  


        
        
  ),
    
 
);