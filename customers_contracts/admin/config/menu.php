<?php

return array(
       "menu"=>array(                   
                        "site.dashboard"=>array(                                            
                            "childs"=>array('site_contracts'=>''),                    
                        ), 
           
                        "Dashboard"=>array(                                            
                            "childs"=>array('00_contracts'=>''),                    
                        ), 
           
                         "Dashboard2"=>array(                                            
                            "childs"=>array('00_contracts'=>''),                    
                        ), 
           
                        "Dashboard3"=>array(                                            
                            "childs"=>array('0000_contracts'=>null,
                                             "0010_dates"=>null,
                                            ),                    
                        ), 
       ),
    
      
       "items"=>array(   // SITE MENU STRUCTURE                                     
           
            "site_contracts"=>array(
                   "title"=>"Customer contracts",                  
                   "route_ajax"=>array('site_ajax'=>array('action'=>'Home')),                 
                   "enabled"=>true,
                   "childs"=>array("customers.contract.status"=>null,
                                    "customers.contract.settings"=>null,
                                    "customers.contract.install_status"=>null,
                                    "customers.contract.time_status"=>null,
                                    "customers.contract.range_date"=>null,
                                    "customers.contract.opc_status"=>null,
                                    "customers.contract.admin_status"=>null,
                                    "customers.contract.treatments"=>null,
                                    "customers.contracts.zone"=>null,  
                                    "customers.contracts.company"=>null,  
                                ),                    
               ),     
                     
            "customers.contract.status"=>array(
                         "title"=>"State",
                         "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListStatus")),                  
                         "picture"=>"/pictures/icons/form.png",
                         "help"=>"modify, add and delete status",      
                         "credentials"=>array(array('superadmin','admin','settings_contract_status')),
                         ),   

             "customers.contract.settings"=>array(
                         "title"=>"Settings contract",
                         "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"Settings")),                  
                         "picture"=>"/pictures/icons/settings.png",
                         "help"=>"modify, add and delete status", 
                         "credentials"=>array(array('superadmin','admin','settings_contract_options')),
                         ),   
           
            "customers.contract.install_status"=>array(
                         "title"=>"Install status",
                         "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListInstallStatus")),                  
                         "picture"=>"/pictures/icons/status32x32.png",
                         "help"=>"modify, add and delete status",      
                         "credentials"=>array(array('superadmin','admin','settings_contract_install_status')),
                         ),  
           
            "customers.contract.time_status"=>array(
                         "title"=>"Time status",
                         "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListTimeStatus")),                  
                         "picture"=>"/pictures/icons/timestatus.png",
                         "help"=>"modify, add and delete status",      
                         "credentials"=>array(array('superadmin','admin','settings_contract_time_status')),
                         ),  
                      
             "customers.contract.range_date"=>array(
                         "title"=>"Range date",
                         "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListRange")),                  
                         "picture"=>"/pictures/icons/day-range32x32.png",
                         "help"=>"modify, add and delete status",      
                         "credentials"=>array(array('superadmin','settings_contract_range_date')),
                         ),  
           
           
            "customers.contract.opc_status"=>array(
                         "title"=>"Opc status",
                         "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListOpcStatus")),                  
                         "picture"=>"/pictures/icons/status32x32.png",
                         "help"=>"modify, add and delete status",      
                         "credentials"=>array(array('superadmin','admin','settings_contract_opc_status')),
                         ),  
           
           
            "customers.contract.admin_status"=>array(
                         "title"=>"Admin status",
                         "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListAdminStatus")),                  
                         "picture"=>"/pictures/icons/status32x32.png",
                         "help"=>"modify, add and delete status",      
                         "credentials"=>array(array('superadmin','admin','settings_contract_admin_status')),
                         ), 
           
            "customers.contract.treatments"=>array(
                         "title"=>"Treatments",
                         "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListTreatment")),                  
                         "picture"=>"/pictures/icons/status32x32.png",
                         "help"=>"modify, add and delete status",      
                         "credentials"=>array(array('superadmin',)),
                         ), 
           
            "customers.contracts.zone"=>array(
                    "title"=>"Zones",
                    "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListZone")), 
                    "credentials"=>array(array('superadmin','settings_contract_zone')),
                    "picture"=>"/pictures/icons/bousole32x32.png",
                    "help"=>"modify, add and delete status",  
               ),
           
             "customers.contracts.company"=>array(
                    "title"=>"Companies",
                    "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListCompany")), 
                    "credentials"=>array(array('superadmin','settings_contract_company')),
                     "picture"=>"/pictures/icons/company.png",
                    "help"=>"modify, add and delete status",  
               ),
           
           
           /* =============DASHBOARD TAB => MENU ============  */
           
            "00_contracts"=>array(
                   "title"=>"Contracts",                                            
                   "enabled"=>true,
                   "component"=>"/customers_contracts/DashboardMenuItem"                 
               ),  
           
            "90_configuration"=>array(
                   "childs"=>array("00_contracts_configuration"=>null)                
               ),  
           
           
           "00_contracts_configuration"=>array(
                   "title"=>"Contracts",                                            
                   "enabled"=>true,
                   "component"=>"/customers_contracts/DashboardConfigurationMenuItem",
                   "childs"=>array("100_contracts_configuration_admin_status"=>null,
                                   "110_contracts_configuration_opc_status"=>null,
                                   "120_contracts_configuration_range_date"=>null,
                                   "130_contracts_configuration_time_status"=>null,
                                   "140_contracts_configuration_install_status"=>null,
                                   "150_contracts_configuration_status"=>null,
                                   "500_contracts_configuration_settings"=>null,
                        )
               ), 
           
           
           "100_contracts_configuration_admin_status"=>array(
                   "title"=>"Admin status",    
                   //"la-icon"=>"",
                   "enabled"=>true,
                   "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListAdminStatus")),   
                   "credentials"=>array(array('superadmin','admin','settings_contract_admin_status')),
                   "component"=>"/customers_contracts/DashboardConfigurationAdminStatusMenuItem"                 
               ), 
           
           "110_contracts_configuration_opc_status"=>array(
                         "title"=>"Opc status",
                        "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListOpcStatus")),        
                        "credentials"=>array(array('superadmin','admin','settings_contract_opc_status')),
                        "component"=>"/customers_contracts/DashboardConfigurationOpcStatusMenuItem"               
                         ),  
           
           "120_contracts_configuration_range_date"=>array(
                         "title"=>"Range date",    
                        "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListRange")),      
                        "component"=>"/customers_contracts/DashboardConfigurationRangeDateMenuItem"               ,
                        "credentials"=>array(array('superadmin','settings_contract_range_date')),
                         ), 
           
             "130_contracts_configuration_time_status"=>array(
                         "title"=>"Time status",       
                        "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListTimeStatus")),      
                        "component"=>"/customers_contracts/DashboardConfigurationTimeStatusMenuItem" ,       
                         "credentials"=>array(array('superadmin','admin','settings_contract_time_status')),
                         ),  
           
            "140_contracts_configuration_install_status"=>array(
                         "title"=>"Install status",
                         "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListInstallStatus")),                 
                         "component"=>"/customers_contracts/DashboardConfigurationInstallStatusMenuItem" ,     
                         "credentials"=>array(array('superadmin','admin','settings_contract_install_status')),
                         ),
           
            "150_contracts_configuration_status"=>array(
                         "title"=>"Contract Status",                 
                         "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListStatus")),       
                         "component"=>"/customers_contracts/DashboardConfigurationStatusMenuItem" ,  
                         "credentials"=>array(array('superadmin','admin','settings_contract_status')),
                         ),  
           
             "500_contracts_configuration_settings"=>array(
                         "title"=>"Settings",     
                        "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"Settings")),    
                        "component"=>"/customers_contracts/DashboardConfigurationSettingsMenuItem" ,    
                         "credentials"=>array(array('superadmin','admin','settings_contract_options')),
                         ),   
           
             "160_contracts_configuration_zone"=>array(
                    "title"=>"Zone",
                    "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListZone")),                  
                    "picture"=>"/pictures/icons/bousole32x32.png",
                    "help"=>"modify, add and delete status",  
               ),   
           
           
            /* =============DASHBOARD TAB => MENU3 ============  */
           
            "9000_configuration"=>array(
                 "childs"=>array("000_contracts_configuration"=>null)                
            ),
            
           "000_contracts_configuration"=>array(
                "title"=>"Contracts",                                            
                   "enabled"=>true,
                   "component"=>"/customers_contracts/DashboardConfigurationMenuItem",
                   "childs"=>array( 
                        )           
           ),
           
            /* =============DASHBOARD3 MENU ============  */
           
             "0000_contracts"=>array(
                   "title"=>"Contracts", 
                   "icon"=>"fa-folder",
                   "enabled"=>true,
                   "component"=>"/customers_contracts/DashboardMenuItem"                 
               ), 
           
            "0010_dates"=>array(
                "title"=>"Dates",
                "icon"=>"fa-calendar",                                
                "route"=>array("customers_contracts_ajax"=>array("action"=>"ListPartialDatesContract")),
                "help"=>"help download",
                "credentials"=>array(array('superadmin','contract_list_dates')),
                "picture"=>"/pictures/icons/contract.png",  
              //  "component"=>"/customers_schedule/tabCustomerMeetingSite",                  
               ), 
           
           
              "0030_customers_contracts_configuration"=>array(
                   "childs"=>array(
                       "0000_customers_contract_settings"=>null,
                       "0010_customers_contract_status"=>null,
                       "0020_customers_contract_time_status"=>null,
                       "0030_customers_contract_admin_status"=>null,
                       "0040_customers_contract_install_status"=>null,
                       "0050_customers_contract_opc_status"=>null,
                       "0120_customers_contracts_zone"=>null,
                       "0130_customers_contract_range_date"=>null,
                     )                
               ), 
           
           
             "0000_customers_contract_settings"=>array(
                         "title"=>"Settings",
                         "icon"=>"fa-cog",
                         "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"Settings")),                  
                         "picture"=>"/pictures/icons/settings.png",
                         "help"=>"modify, add and delete status", 
                         "credentials"=>array(array('superadmin','admin','settings_contract_options')),
                         ),   
           
             "0010_customers_contract_status"=>array(
                         "title"=>"State",
                         "icon"=>"fa-cog",
                         "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListStatus")),                  
                         "picture"=>"/pictures/icons/form.png",
                         "help"=>"modify, add and delete status",      
                         "credentials"=>array(array('superadmin','admin','settings_contract_status')),
                         ),   
           
            "0020_customers_contract_time_status"=>array(
                         "title"=>"Time status",
                         "icon"=>"fa-cog",
                         "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListTimeStatus")),                  
                         "picture"=>"/pictures/icons/timestatus.png",
                         "help"=>"modify, add and delete status",      
                         "credentials"=>array(array('superadmin','admin','settings_contract_time_status')),
                         ),  
                      
            "0030_customers_contract_admin_status"=>array(
                         "title"=>"Admin status",
                         "icon"=>"fa-cog",
                         "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListAdminStatus")),                  
                         "picture"=>"/pictures/icons/status32x32.png",
                         "help"=>"modify, add and delete status",      
                         "credentials"=>array(array('superadmin','admin','settings_contract_admin_status')),
                         ), 
            
            "0040_customers_contract_install_status"=>array(
                         "title"=>"Install status",
                         "icon"=>"fa-cog",
                         "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListInstallStatus")),                  
                         "picture"=>"/pictures/icons/status32x32.png",
                         "help"=>"modify, add and delete status",      
                         "credentials"=>array(array('superadmin','admin','settings_contract_install_status')),
                         ), 
           
           
            "0050_customers_contract_opc_status"=>array(
                         "title"=>"Opc status",
                           "icon"=>"fa-cog",
                         "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListOpcStatus")),                  
                         "picture"=>"/pictures/icons/status32x32.png",
                         "help"=>"modify, add and delete status",      
                         "credentials"=>array(array('superadmin','admin','settings_contract_opc_status')),
                         ),  
           
            "0120_customers_contracts_zone"=>array(
                    "title"=>"Zones",
                    "icon"=>"fa-map-marker",
                    "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListZone")), 
                    "credentials"=>array(array('superadmin','settings_contract_zone')),
                    "picture"=>"/pictures/icons/bousole32x32.png",
                    "help"=>"modify, add and delete status",  
               ),
           
            "0130_customers_contract_range_date"=>array(
                         "title"=>"Range date",
                          "icon"=>"fa-calendar",
                         "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListRange")),                  
                         "picture"=>"/pictures/icons/day-range32x32.png",
                         "help"=>"modify, add and delete status",      
                         "credentials"=>array(array('superadmin','settings_contract_range_date')),
                         ),  
           
             "0150_dashboard_configuration"=>array(  
                 
                   "childs"=>array(
                       "0040_customers_contracts_configuration"=>null, 
                    
                                  )             
           ), 
           
            "0040_customers_contracts_configuration"=>array(   
                  "title"=>"Customers Contracts",                                            
                  "enabled"=>true,
                  "childs"=>array( "0000_customers_contract_settings"=>null,
                       "0030_customers_contract_admin_status"=>null,
                       "0070_customers_contract_install_status"=>null,
                       "0080_customers_contract_opc_status"=>null,
                       "0090_customers_contract_range_date"=>null,
                       "0100_customers_contract_status"=>null,
                       "0110_customers_contract_time_status"=>null,
                       "0120_customers_contract_treatments"=>null,
                       "0130_customers_contracts_company"=>null,
                       "0140_customers_contracts_zone"=>null
                        )
               ), 
     
             "0000_customers_contract_settings"=>array(
                         "title"=>"Settings",
                         "icon"=>"fa-cog",
                         "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"Settings")),                  
                         "picture"=>"/pictures/icons/settings.png",
                         "help"=>"modify, add and delete status", 
                         "credentials"=>array(array('superadmin','admin','settings_contract_options')),
                         ), 
           
              "0030_customers_contract_admin_status"=>array(
                         "title"=>"Admin status",
                         "icon"=>"fa-cog",
                         "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListAdminStatus")),                  
                         "picture"=>"/pictures/icons/status32x32.png",
                         "help"=>"modify, add and delete status",      
                         "credentials"=>array(array('superadmin','admin','settings_contract_admin_status')),
                         ), 
           
           
           
              "0070_customers_contract_install_status"=>array(
                         "title"=>"Install status",
                         "icon"=>"fa-download",
                         "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListInstallStatus")),                  
                         "picture"=>"/pictures/icons/status32x32.png",
                         "help"=>"modify, add and delete status",      
                         "credentials"=>array(array('superadmin','admin','settings_contract_install_status')),
                         ),  
           
           
           "0080_customers_contract_opc_status"=>array(
                         "title"=>"Opc status",
                         "icon"=>"fa-cog",
                         "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListOpcStatus")),                  
                         "picture"=>"/pictures/icons/status32x32.png",
                         "help"=>"modify, add and delete status",      
                         "credentials"=>array(array('superadmin','admin','settings_contract_opc_status')),
                         ),  
           
           
            "0090_customers_contract_range_date"=>array(
                         "title"=>"Range date",
                         "icon"=>"fa-cog",
                         "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListRange")),                  
                         "picture"=>"/pictures/icons/day-range32x32.png",
                         "help"=>"modify, add and delete status",      
                         "credentials"=>array(array('superadmin','settings_contract_range_date')),
                         ),  
           
            "0100_customers_contract_status"=>array(
                         "title"=>"State",
                         "icon"=>"fa-cog",
                         "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListStatus")),                  
                         "picture"=>"/pictures/icons/form.png",
                         "help"=>"modify, add and delete status",      
                         "credentials"=>array(array('superadmin','admin','settings_contract_status')),
                         ),  
           
            "0110_customers_contract_time_status"=>array(
                         "title"=>"Time status",
                         "icon"=>"fa-cog",
                         "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListTimeStatus")),                  
                         "picture"=>"/pictures/icons/timestatus.png",
                         "help"=>"modify, add and delete status",      
                         "credentials"=>array(array('superadmin','admin','settings_contract_time_status')),
                         ),  
           
            "0120_customers_contract_treatments"=>array(
                         "title"=>"Treatments",
                         "icon"=>"fa-cog",
                         "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListTreatment")),                  
                         "picture"=>"/pictures/icons/status32x32.png",
                         "help"=>"modify, add and delete status",      
                         "credentials"=>array(array('superadmin',)),
                         ), 
           
            
           
            "0140_customers_contracts_zone"=>array(
                    "title"=>"Zones",
                    "icon"=>"fa-cog",
                    "route_ajax"=>array("customers_contracts_ajax"=>array("action"=>"ListZone")), 
                    "credentials"=>array(array('superadmin','settings_contract_zone')),
                    "picture"=>"/pictures/icons/bousole32x32.png",
                    "help"=>"modify, add and delete status",  
               ),
           
            
  ),
    
    
);