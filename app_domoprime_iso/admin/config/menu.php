<?php


return array(

    "menu"=>array(                   
                        "site.dashboard"=>array(                                            
                            "childs"=>array('site_domoprime'=>''),                    
                        ),                    
       ),
      
       "items"=>array(   // SITE MENU STRUCTURE 
           
                 "site_domoprime"=>array(                 
                   "childs"=>array("site_domoprime.12_occupation"=>null,
                                   "site_domoprime.15_layer"=>null,                                  
                                   "site_domoprime.00_settings"=>null, 
                                   "site_domoprime.28_simulation_model"=>null,                                
                            ),                                      
                 ), 
                      
                  "site_domoprime.12_occupation"=>array(
                             "title"=>"Occupation",
                             "route_ajax"=>array("app_domoprime_iso_ajax"=>array("action"=>"ListOccupation")),                                               
                             "help"=>"modify, add and delete status",   
                             "picture"=>"/pictures/icons/owner32x32.png",
                             "credentials"=>array(array('superadmin','admin','settings_app_domoprime_iso_occupation')),
                ), 
           
                   "site_domoprime.15_layer"=>array(
                             "title"=>"Layer type",
                             "route_ajax"=>array("app_domoprime_iso_ajax"=>array("action"=>"ListTypeLayer")),                  
                             "picture"=>"/pictures/icons/layer32x32.png",
                             "help"=>"modify, add and delete status",  
                            "credentials"=>array(array('superadmin','admin','settings_app_domoprime_iso_layer')),
                ), 
           
               "site_domoprime.00_settings"=>array(
                            "title"=>"Settings model document ISO",
                            "picture"=>"/pictures/icons/settings.png",
                            "route_ajax"=>array("app_domoprime_iso_ajax"=>array("action"=>"Settings")),     
                            "component"=>"/app_domoprime_iso/DashboardMenuIsoItem",
                            "credentials"=>array(array('superadmin','admin','settings_app_domoprime_iso_settings')),
                ), 
           
                  "site_domoprime.28_simulation_model"=>array(
                    "title"=>"Simulation models",
                    "route_ajax"=>array("app_domoprime_iso_ajax"=>array("action"=>"ListSimulationModel")),                  
                    "picture"=>"/pictures/icons/doc32x32.png",
                    "help"=>"modify, add and delete status", 
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_simulation_model')),
                    ), 
                        
            
    
    
        /* ================ STRUCTURE TAB => MENU ==================== */
           "25_customers"=>array(                  
                   "childs"=>array("150_customers_app_domoprime_iso_requests"=>null,   
                       "160_customers_app_domoprime_iso_simulations"=>null,
                                  )             
           ),                                  
                      
            "150_customers_app_domoprime_iso_requests"=>array(
                   "title"=>"Requests",  
                   "enabled"=>true,
                   "route_ajax"=>array("app_domoprime_iso_ajax"=>array("action"=>"ListPartialRequest")),              
                   "component"=>"/app_domoprime_iso/DashboardCustomerRequestMenuItem",    
                   "credentials"=>array(array('superadmin','admin','app_domoprime_iso_requests_list')),
            ), 
           
            "160_customers_app_domoprime_iso_simulations"=>array(
                   "title"=>"Simulations",                                                                      
                    "route_ajax"=>array("app_domoprime_iso_ajax"=>array("action"=>"ListPartialSimulation")),                                                                   
                    "credentials"=>array(array('superadmin','admin','app_domoprime_iso_simulation_list')),         
            ), 
                      
        
         "40_app_domoprime_configuration"=>array(                                  
                   "childs"=>array(                       
                       "15_app_domoprime_configuration_occupation"=>null,
                       "17_app_domoprime_configuration_layer"=>null,
                       "85_app_domoprime_configuration_simulation_model"=>null,
                       "95_app_domoprime_configuration_settings"=>null,
                       )
               ),
         
           "15_app_domoprime_configuration_occupation"=>array(
                             "title"=>"Occupation",
                             "route_ajax"=>array("app_domoprime_iso_ajax"=>array("action"=>"ListOccupation")),                                                                           
                             "credentials"=>array(array('superadmin','admin','settings_app_domoprime_iso_occupation')),
                ), 
           
            "17_app_domoprime_configuration_layer"=>array(
                             "title"=>"Layer type",
                             "route_ajax"=>array("app_domoprime_iso_ajax"=>array("action"=>"ListTypeLayer")),                                               
                            "credentials"=>array(array('superadmin','admin','settings_app_domoprime_iso_layer')),
                ), 
           
               "95_app_domoprime_configuration_settings"=>array(
                            "title"=>"SettingsX", 
                            "component"=>"/app_domoprime_iso/DashboardMenuIsoSettingsItem", 
                            "route_ajax"=>array("app_domoprime_iso_ajax"=>array("action"=>"Settings")),                              
                            "credentials"=>array(array('superadmin','admin','settings_app_domoprime_iso_settings')),
                ), 
           
                  "85_app_domoprime_configuration_simulation_model"=>array(
                    "title"=>"Simulation models",
                    "route_ajax"=>array("app_domoprime_iso_ajax"=>array("action"=>"ListSimulationModel")),                                     
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_simulation_model')),
                    ),    
           
           
            /* =============DASHBOARD3 MENU ============  */
    
           "0040_customers"=>array(                  
                   "childs"=>array("0020_customers_app_domoprime_iso_requests"=>null,   
                                   "0030_customers_app_domoprime_iso_simulations"=>null,
                                  )             
           ),    
    
    
          "0020_customers_app_domoprime_iso_requests"=>array(
                   "title"=>"Requests", 
                   "icon"=>"fa-cog",
                   "enabled"=>true,
                   "route_ajax"=>array("app_domoprime_iso_ajax"=>array("action"=>"ListPartialRequest")),              
                   "component"=>"/app_domoprime_iso/DashboardCustomerRequestMenuItem",                  
            ), 
           
            "0030_customers_app_domoprime_iso_simulations"=>array(
                   "title"=>"Simulations",  
                   "icon"=>"fa-cog",
                    "route_ajax"=>array("app_domoprime_iso_ajax"=>array("action"=>"ListPartialSimulation")),                                                                   
                    "credentials"=>array(array('superadmin','admin','app_domoprime_iso_simulation_list')),           
            ), 
    
         "0120_documents"=>array(                  
                   "childs"=>array(
                       "0030_dashboard-customers-meeting-app-domoprime-simulations"=>null,
                                  )             
           ), 
    
         "0030_dashboard-customers-meeting-app-domoprime-simulations"=>array(
                                    "title"=>"Simulations",                                  
                                    "icon"=>"table",
                                    "route"=>array("app_domoprime_iso_ajax"=>array("action"=>"ListPartialSimulation")),                                  
                                   // "picture"=>"/pictures/icons/meeting.png",  
                                    "credentials"=>array(array('superadmin','admin','app_domoprime_iso_simulation_list')),
                                   
                ),
               
      "0070_iso_configuration"=>array(                                        
                  "childs"=>array(
                      "0050_app_domoprime_configuration_occupation"=>null,    
                      "0060_app_domoprime_configuration_layer"=>null,   
                      "0130_app_domoprime_configuration_simulation_model"=>null,
                      "0160_app_domoprime_configuration_settings"=>null
                     
                   )                   
               ),  
           
       "0050_app_domoprime_configuration_occupation"=>array(
                             "title"=>"Occupation",
                             "icon"=>"fa-cog",
                             "route_ajax"=>array("app_domoprime_iso_ajax"=>array("action"=>"ListOccupation")),                                               
                             "help"=>"modify, add and delete status",   
                             "picture"=>"/pictures/icons/owner32x32.png",
                             "credentials"=>array(array('superadmin','admin','settings_app_domoprime_iso_occupation')),
                ), 
           
     "0060_app_domoprime_configuration_layer"=>array(
                             "title"=>"Layer type",
                             "route_ajax"=>array("app_domoprime_iso_ajax"=>array("action"=>"ListTypeLayer")),                  
                             "picture"=>"/pictures/icons/layer32x32.png",
                             "help"=>"modify, add and delete status",  
                            "credentials"=>array(array('superadmin','admin','settings_app_domoprime_iso_layer')),
                ), 

    
       "0130_app_domoprime_configuration_simulation_model"=>array(
                    "title"=>"Simulation models",
                    "icon"=>"fa-cog",
                    "route_ajax"=>array("app_domoprime_iso_ajax"=>array("action"=>"ListSimulationModel")),                  
                    "picture"=>"/pictures/icons/doc32x32.png",
                    "help"=>"modify, add and delete status", 
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_simulation_model')),
                    ), 
    
    "0160_app_domoprime_configuration_settings"=>array(
                            "title"=>"Settings",
                            "icon"=>"fa-cog",
                            "picture"=>"/pictures/icons/settings.png",
                            "route_ajax"=>array("app_domoprime_iso_ajax"=>array("action"=>"Settings")),     
                            "component"=>"/app_domoprime_iso/DashboardMenuIsoItem",
                            "credentials"=>array(array('superadmin','admin','settings_app_domoprime_iso_settings')),
                ), 
           
           
           
           /*===============================DASHBOARD==========================*/
             "0040_iso_configuration"=>array(                                        
                  "childs"=>array(
                      "050_app_domoprime_configuration_occupation"=>null,    
                      "060_app_domoprime_configuration_layer"=>null,   
                      "130_app_domoprime_configuration_simulation_model"=>null,
                      "160_app_domoprime_configuration_settings"=>null
                     
                   )                   
               ),  
           
       "050_app_domoprime_configuration_occupation"=>array(
                             "title"=>"Occupation",
                             "route_ajax"=>array("app_domoprime_iso_ajax"=>array("action"=>"ListOccupation")),                                               
                             "credentials"=>array(array('superadmin','admin','settings_app_domoprime_iso_occupation')),
                ), 
           
     "060_app_domoprime_configuration_layer"=>array(
                             "title"=>"Layer type",
                             "route_ajax"=>array("app_domoprime_iso_ajax"=>array("action"=>"ListTypeLayer")),                  
                            "credentials"=>array(array('superadmin','admin','settings_app_domoprime_iso_layer')),
                ), 

    
       "130_app_domoprime_configuration_simulation_model"=>array(
                    "title"=>"Simulation models",
                    "route_ajax"=>array("app_domoprime_iso_ajax"=>array("action"=>"ListSimulationModel")),                  
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_simulation_model')),
                    ), 
    
    "160_app_domoprime_configuration_settings"=>array(
                            "title"=>"Settings",
                            "route_ajax"=>array("app_domoprime_iso_ajax"=>array("action"=>"Settings")),     
                            "component"=>"/app_domoprime_iso/DashboardMenuIsoItem",
                            "credentials"=>array(array('superadmin','admin','settings_app_domoprime_iso_settings')),
                ), 
        ),    
);