<?php


return array(

    "menu"=>array(                   
                        "site.dashboard"=>array(                                            
                            "childs"=>array('site_domoprime'=>'',
                           
                                ),                    
                        ),  
                        
                        "Dashboard"=>array(                                            
                            "childs"=>array('meeting_quotations'=>'',
                                ),                    
                        ), 
         
                        "Dashboard3"=>array(                                            
                            "childs"=>array( '0120_documents'=>null
                                            ),                    
                        ),            
    
       ),
      
       "items"=>array(   // SITE MENU STRUCTURE 
           
                 "site_domoprime"=>array(
                   "title"=>"ISO",                  
                   "route_ajax"=>array('site_ajax'=>array('action'=>'Home')),
                   "enabled"=>true,
                   "childs"=>array("site_domoprime.00_zone"=>null,"site_domoprime.10_energy"=>null,
                                    "site_domoprime.15_documents"=>null,
                                    "site_domoprime.20_class"=>null,  
                                    "site_domoprime.25_quotation_model"=>'',
                                    "site_domoprime.28_billing_model"=>'',
                                    "site_domoprime.29_asset_model"=>'',
                                    "site_domoprime.29_as_premeeting_model"=>'',
                                    "site_domoprime.29_as_after_work_model"=>'',
                                    "site_domoprime.29_polluting"=>null,
                                    "site_domoprime.30_settings"=>null,                                  
                            ),           
                            "credentials"=>array(array('superadmin','admin','app_domoprime')),
                 ), 
                      
                  "site_domoprime.00_zone"=>array(
                             "title"=>"Sectors",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListZone")),                  
                             "picture"=>"/pictures/icons/sectors.png",
                             "help"=>"modify, add and delete status",        
                             "credentials"=>array(array('superadmin','admin',)),
                ), 
           
                   "site_domoprime.10_energy"=>array(
                             "title"=>"Energy type",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListEnergy")),                  
                             "picture"=>"/module/app_domoprime/pictures/energy32x32.png",
                             "help"=>"modify, add and delete status",  
                            "credentials"=>array(array('superadmin','admin','settings_app_domoprime_energy')),
                ), 
           
                    "site_domoprime.20_class"=>array(
                             "title"=>"Classes",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListClass")),                  
                             "picture"=>"/pictures/icons/customer.png",
                             "help"=>"modify, add and delete status",   
                             "credentials"=>array(array('superadmin','admin','settings_app_domoprime_class')),
                ), 
           
                   "site_domoprime.25_quotation_model"=>array(
                    "title"=>"Quotation models",
                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListQuotationModel")),                  
                    "picture"=>"/pictures/icons/doc32x32.png",
                    "help"=>"modify, add and delete status", 
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_quotation_model')),
                    ), 
           
             "site_domoprime.28_billing_model"=>array(
                    "title"=>"Billing models",
                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListBillingModel")),                  
                    "picture"=>"/pictures/icons/doc32x32.png",
                    "help"=>"modify, add and delete status", 
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_billing_model')),
                    ), 
           
           
            "site_domoprime.29_asset_model"=>array(
                    "title"=>"Asset models",
                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListAssetModel")),                  
                    "picture"=>"/pictures/icons/doc32x32.png",
                    "help"=>"modify, add and delete status", 
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_asset_model')),
                    ), 
           
             "site_domoprime.30_settings"=>array(
                             "title"=>"Settings ISO1",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"Settings")),                  
                              "picture"=>"/pictures/icons/settings.png",
                             "help"=>"modify, add and delete status",  
                            "credentials"=>array(array('superadmin','admin','settings_app_domoprime_settings')),
                ), 
           
           
       	
				
		"site_domoprime.29_polluting"=>array(
                             "title"=>"Pollutings",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListPollutingCompany")),                  
                             "picture"=>"/pictures/icons/sav.jpg",
                             "help"=>"modify, add and delete status",
                             "credentials"=>array(array('superadmin','admin','settings_app_domoprime_polluters')),
                ),
           
           
                "site_domoprime.15_documents"=>array(
                             "title"=>"Documents model class ISO",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListDocument")),                  
                             "picture"=>"/pictures/icons/doc32x32.png",
                             "help"=>"modify, add and delete status",
                             "credentials"=>array(array('superadmin','admin','settings_app_domoprime_documents')),
                ),
           
                 "site_domoprime.29_as_premeeting_model"=>array(
                    "title"=>"Pre meeting models",
                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListPreMeetingModel")),                  
                    "picture"=>"/pictures/icons/doc32x32.png",
                    "help"=>"modify, add and delete status", 
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_premeting_model')),
                    ), 
           
                "site_domoprime.29_as_after_work_model"=>array(
                    "title"=>"After work models",
                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListAfterWorkModel")),                  
                    "picture"=>"/pictures/icons/doc32x32.png",
                    "help"=>"modify, add and delete status", 
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_afterwork_model')),
                    ), 
           
           
           /* ================ STRUCTURE TAB => MENU ==================== */
           "25_customers"=>array(                  
                   "childs"=>array("100_customers_app_domoprime_cumacs"=>null,                                  
                                  )             
           ),                                  
                      
            "100_customers_app_domoprime_cumacs"=>array(
                   "title"=>"Cumacs",                                            
                   "enabled"=>true,
                   "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListPartialCalculation")),
                   "component"=>"/app_domoprime/DashboardDocumentMenuItem",   
                "credentials"=>array(array('superadmin','admin','app_domoprime_calculation')),
            ), 
           
                      
            "90_configuration"=>array(
                   "childs"=>array("40_app_domoprime_configuration"=>null)                
               ),
        
         "40_app_domoprime_configuration"=>array(
                   "title"=>"ISO",                                            
                   "enabled"=>true,                  
                   "childs"=>array(
                       "00_app_domoprime_configuration_zone"=>null,
                       "10_app_domoprime_configuration_energy"=>null,                       
                        "20_app_domoprime_configuration_class"=>null,
                        "30_app_domoprime_configuration_quotation_model"=>null,
                       "40_app_domoprime_configuration__billing_model"=>null,
                       "50_app_domoprime_configuration_asset_model"=>null,
                       "60_app_domoprime_configuration_polluting"=>null,
                //       "70_app_domoprime_configuration_documents"=>null,
                       "80_app_domoprime_configuration_premeeting_model"=>null, 
                       "90_app_domoprime_configuration_settings"=>null,
                       )
               ),       
           
          "00_app_domoprime_configuration_zone"=>array(
                             "title"=>"Sectors",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListZone")),                                                  
                             "credentials"=>array(array('superadmin','admin',)),
                ), 
           
           
            "10_app_domoprime_configuration_energy"=>array(
                             "title"=>"Energy",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListEnergy")),                                              
                            "credentials"=>array(array('superadmin','admin','settings_app_domoprime_energy')),
                ), 
           
                    "20_app_domoprime_configuration_class"=>array(
                             "title"=>"Classes",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListClass")),                  
                             "picture"=>"/pictures/icons/customer.png",
                             "help"=>"modify, add and delete status",   
                             "credentials"=>array(array('superadmin','admin','settings_app_domoprime_class')),
                ), 
           
                   "30_app_domoprime_configuration_quotation_model"=>array(
                    "title"=>"Quotation models",
                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListQuotationModel")),                  
                    "picture"=>"/pictures/icons/doc32x32.png",
                    "help"=>"modify, add and delete status", 
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_quotation_model')),
                    ), 
           
             "40_app_domoprime_configuration__billing_model"=>array(
                    "title"=>"Billing models",
                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListBillingModel")),                                    
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_billing_model')),
                    ), 
           
           
            "50_app_domoprime_configuration_asset_model"=>array(
                    "title"=>"Asset models",
                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListAssetModel")),                                     
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_asset_model')),
                    ), 
           
             "90_app_domoprime_configuration_settings"=>array(
                             "title"=>"Settings",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"Settings")),                                             
                            "credentials"=>array(array('superadmin','admin','settings_app_domoprime_settings')),
                ), 
           
           
       	
				
		"60_app_domoprime_configuration_polluting"=>array(
                             "title"=>"Pollutings",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListPollutingCompany")),                                              
                             "credentials"=>array(array('superadmin','admin','settings_app_domoprime_polluters')),
                ),
           
           
                "70_app_domoprime_configuration_documents"=>array(
                             "title"=>"Documents",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListDocument")),                                              
                             "credentials"=>array(array('superadmin','admin','settings_app_domoprime_documents')),
                ),
           
                 "80_app_domoprime_configuration_premeeting_model"=>array(
                    "title"=>"Pre meeting models",
                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListPreMeetingModel")),                                     
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_premeting_model')),
                    ), 
           
           
            "77_documents"=>array(
                   "title"=>"Documents",                                            
                   "childs"=>array(
                       "20_documents_app_domoprime_quotations"=>null,
                       "30_documents_app_domoprime_billings"=>null,
                       "40_documents_app_domoprime_assets"=>null,
                   )             
               ),  
           
            "20_documents_app_domoprime_quotations"=>array(
                                    "title"=>"Quotations",                                 
                                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListPartialQuotation")),                                 
                                    "credentials"=>array(array('superadmin','admin','app_domoprime_quotation_list')),       
                
                ),
           
           
            "30_documents_app_domoprime_billings"=>array(
                                    "title"=>"Billings",                                 
                                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListPartialBilling")),                                   
                                    "credentials"=>array(array('superadmin','admin','app_domoprime_billing_list')),                                 
                ), 
                
                   "40_documents_app_domoprime_assets"=>array(
                                    "title"=>"Assets",                                
                                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListPartialAsset")),                                 
                                    "credentials"=>array(array('superadmin','admin','app_domoprime_asset_list')),                   
                       
                ), 
           
                       
            "80_statistics"=>array(                  
                   "childs"=>array(
                         "00_statistics_app_domoprime_report"=>null,
                       "10_statistics_app_domoprime_operation"=>null,
                   )
               ), 
           
           "00_statistics_app_domoprime_report"=>array(
                                    "title"=>"Cumac Report",                                 
                                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"Report")),                                   
                                    "credentials"=>array(array('superadmin','admin','domoprime_report')),                         
                ), 
           
            "10_statistics_app_domoprime_operation"=>array(
                                    "title"=>"Operations",                                  
                                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"StatisticOperations")),
                                     "credentials"=>array(array('superadmin','domoprime_statistics_operations')),
                                 //   "component"=>"/site_statistics/tab",   
                ),          
    
           
       /* =============DASHBOARD3 MENU ============  */

        "0040_customers"=>array(                  
                   "childs"=>array("0010_customers_app_domoprime_cumacs"=>null,                                  
                                  )             
           ), 
    
       "0010_customers_app_domoprime_cumacs"=>array(
                   "title"=>"Cumacs",   
                   "icon"=>"fa-list",
                   "enabled"=>true,
                   "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListPartialCalculation")),
                   "component"=>"/app_domoprime/DashboardDocumentMenuItem",                  
            ), 
          "0080_dashboard_customers_configuration"=>array(                                                  
                  "childs"=>array(                   
                      "0040_domoprime_settings_configuration"=>null,
                      )
                 ),
        "0040_domoprime_settings_configuration"=>array(
                  "title"=>"ISO/CHAUDIERE/PACK/ITE",                                            
                  "enabled"=>true,                                    
                  "childs"=>array(
                      "0030_site_domoprime_polluting"=>null,                      
                   )
                   
               ),             
           
      "0030_site_domoprime_polluting"=>array(
                             "title"=>"Pollutings",
                             "icon"=>"fa-list",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListPollutingCompany")),                  
                             "picture"=>"/pictures/icons/sav.jpg",
                             "help"=>"modify, add and delete status",
                             "credentials"=>array(array('superadmin','admin','settings_app_domoprime_polluters')),
                ),  
           
           
      
      "0120_documents"=>array(  
                  "title"=>"Documents",   
                   "icon"=>"fa-file",
                   "enabled"=>true,
                   "component"=>"/dashboard/DashboardDocumentsMenuItem"   ,
                   "childs"=>array(
                       "0000_documents_app_domoprime_quotations"=>null, 
                       "0010_documents_app_domoprime_billings"=>null,
                       "0020_documents_app_domoprime_assets"=>null,
                                  )             
           ), 
    
      "0000_documents_app_domoprime_quotations"=>array(
                            "title"=>"Quotations",   
                            "icon"=>"fa-list",
                            "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListPartialQuotation")),                                 
                            "credentials"=>array(array('superadmin','admin','app_domoprime_quotation_list')),                                 
        ),
       
     "0010_documents_app_domoprime_billings"=>array(
                           "title"=>"Billings",  
                           "icon"=>"fa-list",
                           "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListPartialBilling")),                                   
                           "credentials"=>array(array('superadmin','admin','app_domoprime_billing_list')),                                 
       ), 

       "0020_documents_app_domoprime_assets"=>array(
                           "title"=>"Assets",  
                           "icon"=>"fa-list",
                           "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListPartialAsset")),                                 
                           "credentials"=>array(array('superadmin','admin','app_domoprime_asset_list')),                                
       ), 
           
           
       "0140_accounting"=>array(                  
                   "childs"=>array(
                       "0000_statistics_app_domoprime_report"=>null,
                       "0010_statistics_app_domoprime_operation"=>null,
                   )
               ), 
           
           "0000_statistics_app_domoprime_report"=>array(
                                    "title"=>"Cumac Report",   
                                    "icon"=>"fa-list",
                                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"Report")),                                   
                                    "credentials"=>array(array('superadmin','admin','domoprime_report')),                                   
                ), 
           
            "0010_statistics_app_domoprime_operation"=>array(
                                    "title"=>"Operations",  
                                    "icon"=>"fa-list",
                                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"StatisticOperations")),
                                    "credentials"=>array(array('superadmin','domoprime_statistics_operations')),
                                 // "component"=>"/site_statistics/tab",   
                ),          
             "0150_dashboard_configuration"=>array(                  
                   "childs"=>array(
                       "0070_iso_configuration"=>null, 
                       "0080_app_domoprime_iso2_configuration"=>null,
                    
                                  )             
             ), 
            "0070_iso_configuration"=>array( 
                 "title"=>"ISO",    
                 "icon"=>"fa-list",
                  "enabled"=>true,
                  "childs"=>array(
                      "0030_app_domoprime_configuration_zone"=>null,    
                      "0040_app_domoprime_configuration_energy"=>null,
                      "0070_app_domoprime_configuration_class"=>null,
                      "0080_app_domoprime_configuration_quotation_model"=>null,
                      "0090_app_domoprime_configuration__billing_model"=>null,
                      "0100_app_domoprime_configuration_asset_model"=>null,
                      "0110_app_domoprime_configuration_polluting"=>null,
                      "0120_app_domoprime_configuration_premeeting_model"=>null,
                      "140_site_domoprime_as_after_work_model"=>null,
                      "0150_app_domoprime_configuration_settings"=>null,
                   )                   
               ),  
           
           
           
            "0030_app_domoprime_configuration_zone"=>array(
                             "title"=>"Sectors",
                             "icon"=>"fa-list",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListZone")),                  
                             "picture"=>"/pictures/icons/sectors.png",
                             "help"=>"modify, add and delete status",        
                             "credentials"=>array(array('superadmin','admin',)),
                ), 
           
              "0040_app_domoprime_configuration_energy"=>array(
                             "title"=>"Energy",
                             "icon"=>"fa-list",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListEnergy")),                  
                             "picture"=>"/module/app_domoprime/pictures/energy32x32.png",
                             "help"=>"modify, add and delete status",  
                            "credentials"=>array(array('superadmin','admin','settings_app_domoprime_energy')),
                ), 
           
             "0070_app_domoprime_configuration_class"=>array(
                             "title"=>"Classes",
                             "icon"=>"fa-list",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListClass")),                  
                             "picture"=>"/pictures/icons/customer.png",
                             "help"=>"modify, add and delete status",   
                             "credentials"=>array(array('superadmin','admin','settings_app_domoprime_class')),
                ), 
           
             "0080_app_domoprime_configuration_quotation_model"=>array(
                    "title"=>"Quotation models",
                   "icon"=>"fa-list",
                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListQuotationModel")),                  
                    "picture"=>"/pictures/icons/doc32x32.png",
                    "help"=>"modify, add and delete status", 
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_quotation_model')),
                    ), 
           
           
            "0090_app_domoprime_configuration__billing_model"=>array(
                    "title"=>"Billing models",
                    "icon"=>"fa-list",
                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListBillingModel")),                  
                    "picture"=>"/pictures/icons/doc32x32.png",
                    "help"=>"modify, add and delete status", 
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_billing_model')),
                    ), 
           
           
             "0100_app_domoprime_configuration_asset_model"=>array(
                    "title"=>"Asset models",
                    "icon"=>"fa-list",
                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListAssetModel")),                  
                    "picture"=>"/pictures/icons/doc32x32.png",
                    "help"=>"modify, add and delete status", 
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_asset_model')),
                    ), 
           
           
           "0110_app_domoprime_configuration_polluting"=>array(
                             "title"=>"Pollutings",
                             "icon"=>"fa-list",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListPollutingCompany")),                  
                             "picture"=>"/pictures/icons/sav.jpg",
                             "help"=>"modify, add and delete status",
                             "credentials"=>array(array('superadmin','admin','settings_app_domoprime_polluters')),
                ),
           
             "0120_app_domoprime_configuration_premeeting_model"=>array(
                    "title"=>"Pre meeting models",
                    "icon"=>"fa-list",
                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListPreMeetingModel")),                  
                    "picture"=>"/pictures/icons/doc32x32.png",
                    "help"=>"modify, add and delete status", 
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_premeting_model')),
                    ), 
           
           "140_site_domoprime_as_after_work_model"=>array(
                    "title"=>"After work models",
                    "icon"=>"fa-list",
                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListAfterWorkModel")),                  
                    "picture"=>"/pictures/icons/doc32x32.png",
                    "help"=>"modify, add and delete status", 
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_afterwork_model')),
                    ), 
           
            "0150_app_domoprime_configuration_settings"=>array(
                             "title"=>"Settings",   
                             "icon"=>"fa-cog",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"Settings")),                  
                              "picture"=>"/pictures/icons/settings.png",
                             "help"=>"modify, add and delete status",  
                            "credentials"=>array(array('superadmin','admin','settings_app_domoprime_settings')),
                ), 
           
           
            "0080_app_domoprime_iso2_configuration"=>array(  
                  "title"=>"ISO2",   
                 "icon"=>"fa-list",
                  "enabled"=>true,
                  "childs"=>array(
                      "0010_app_domoprime_configuration_zone"=>null,
                      "0020_site_domoprime.energy"=>null,
                      
                   )
           ),
           
           
            "0010_app_domoprime_configuration_zone"=>array(
                             "title"=>"Sectors",
                             "icon"=>"fa-list",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListZone")),                  
                             "picture"=>"/pictures/icons/sectors.png",
                             "help"=>"modify, add and delete status",        
                             "credentials"=>array(array('superadmin','admin',)),
                ), 
           
           
              "0020_site_domoprime.energy"=>array(
                             "title"=>"Energy",
                             "icon"=>"fa-list",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListEnergy")),                  
                             "picture"=>"/module/app_domoprime/pictures/energy32x32.png",
                             "help"=>"modify, add and delete status",  
                            "credentials"=>array(array('superadmin','admin','settings_app_domoprime_energy')),
                ), 
           
             "0090_participants_configuration"=>array(                                           
                  "childs"=>array(
                      "0030_site_domoprime_polluting"=>null,
                      "0040_site_domoprime_quotation_model"=>null,
                      "0050_site_domoprime_billing_model"=>null,
                      "0060_site_domoprime_as_after_work_model"=>null,
                      "0070_site_domoprime_as_premeeting_model"=>null,
                      "0080_app_domoprime_configuration_asset_model"=>null,
                      "0100_site_domoprime_energy"=>null,
                      "0130_site_domoprime_polluting"=>null,
                      
                 
                   )
            ),
           
           "0030_site_domoprime_polluting"=>array(
                             "title"=>"Pollutings",
                             "icon"=>"fa-list",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListPollutingCompany")),                  
                             "picture"=>"/pictures/icons/sav.jpg",
                             "help"=>"modify, add and delete status",
                             "credentials"=>array(array('superadmin','admin','settings_app_domoprime_polluters')),
                ),
           
           
            "0040_site_domoprime_quotation_model"=>array(
                     "title"=>"Quotation models",
                    "icon"=>"fa-list",
                     "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListQuotationModel")),                  
                    "picture"=>"/pictures/icons/doc32x32.png",
                    "help"=>"modify, add and delete status", 
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_quotation_model')),
                    ), 
           
           
           
            "0050_site_domoprime_billing_model"=>array(
                    "title"=>"Billing models",
                    "icon"=>"fa-list",
                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListBillingModel")),                  
                    "picture"=>"/pictures/icons/doc32x32.png",
                    "help"=>"modify, add and delete status", 
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_billing_model')),
                    ), 
           
           
           "0060_site_domoprime_as_after_work_model"=>array(
                    "title"=>"After work models",
                    "icon"=>"fa-list",
                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListAfterWorkModel")),                  
                    "picture"=>"/pictures/icons/doc32x32.png",
                    "help"=>"modify, add and delete status", 
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_afterwork_model')),
                    ), 
           
           
            "0070_site_domoprime_as_premeeting_model"=>array(
                    "title"=>"Pre meeting models",
                    "icon"=>"fa-list",
                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListPreMeetingModel")),                  
                    "picture"=>"/pictures/icons/doc32x32.png",
                    "help"=>"modify, add and delete status", 
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_premeting_model')),
                    ), 
           
           
           "0080_app_domoprime_configuration_asset_model"=>array(
                    "title"=>"Asset models",
                    "icon"=>"fa-list",
                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListAssetModel")),                  
                    "picture"=>"/pictures/icons/doc32x32.png",
                    "help"=>"modify, add and delete status", 
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_asset_model')),
                    ), 
           
           
            "0100_site_domoprime_energy"=>array(
                             "title"=>"Energy",
                             "icon"=>"fa-list",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListEnergy")),                  
                             "picture"=>"/module/app_domoprime/pictures/energy32x32.png",
                             "help"=>"modify, add and delete status",  
                            "credentials"=>array(array('superadmin','admin','settings_app_domoprime_energy')),
                ), 
           
           
              "0130_site_domoprime_polluting"=>array(
                             "title"=>"Classes",
                             "icon"=>"fa-list",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListClass")),                  
                             "picture"=>"/pictures/icons/customer.png",
                             "help"=>"modify, add and delete status",   
                             "credentials"=>array(array('superadmin','admin','settings_app_domoprime_class')),
                ), 
            "0150_dashboard_configuration"=>array(   
                
                   "childs"=>array(
                       "0100_pack_boiler_configuration"=>null, 
                    
                                  )             
           ), 
           
            "0100_pack_boiler_configuration"=>array(  
                "title"=>"CHAUDIERE PACK",                                            
                  "enabled"=>true,
                  "childs"=>array(
                      "0000_site_domoprime_class"=>null,
                      "0020_site_domoprime_polluting"=>null
                 
                   )
            ),
           
           
           
            "0000_site_domoprime_class"=>array(
                             "title"=>"Classes",
                              "icon"=>"fa-list",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListClass")),                  
                             "picture"=>"/pictures/icons/customer.png",
                             "help"=>"modify, add and delete status",   
                             "credentials"=>array(array('superadmin','admin','settings_app_domoprime_class')),
                ), 
           
           "0020_site_domoprime_polluting"=>array(
                             "title"=>"Pollutings",
                              "icon"=>"fa-list",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListPollutingCompany")),                  
                             "picture"=>"/pictures/icons/sav.jpg",
                             "help"=>"modify, add and delete status",
                             "credentials"=>array(array('superadmin','admin','settings_app_domoprime_polluters')),
                ),
           
           /*===========================Dashboard===============*/
           "00_iso2_configuration"=>array(                                             
                   "childs"=>array("0000_app_domoprime_energy"=>null,
                       "0010_app_domoprime_zone"=>null,
                     
                       
                       )                
               ),  
           
             "0000_app_domoprime_energy"=>array(
                    "title"=>"Prices",
                    "route_ajax"=>array("app_domoprime_iso2_ajax"=>array("action"=>"ListPrice")),                                
                    "credentials"=>array(array('superadmin','settings_app_domoprime_iso2_prices')),
             ),
             "0010_app_domoprime_zone"=>array(
                       "title"=>"Sectors",
                      "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListZone")),                      
                      "credentials"=>array(array('superadmin','admin','menu_configuration_admin')),
             ),
           
           
           
           
             "90_configuration"=>array(
                 
                   "childs"=>array("30_domoprime_config"=>null,
                       "0040_iso_configuration"=>null,
                      
                       
                       )                
               ),  
             "30_domoprime_config"=>array(
                   "title"=>"ISO/CHAUDIERE/PACK/ITE",                                                 
                   "childs"=>array(
                       "0010_domoprime_polluting"=>null,
                       "0020_domoprime_class"=>null,
                       "0050_domoprime_energy"=>null,
                       "0060_domoprime_asset_model"=>null,
                       "0070_domoprime_premeeting_model"=>null,
                       "0080_domoprime_after_work_model"=>null,
                       "0090_domoprime_billing_model"=>null,
                       "0100_domoprime_quotation_model"=>null,
                     
                       )                
               ),  
             "0010_domoprime_polluting"=>array(
                   "title"=>"Pollutings",
                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListPollutingCompany")),                  
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_polluters')),
             ),
           
            "0020_domoprime_class"=>array(
                             "title"=>"Classes",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListClass")),                  
                             "credentials"=>array(array('superadmin','admin','settings_app_domoprime_class')),
                ), 
           
             "0050_domoprime_energy"=>array(
                             "title"=>"Energy type",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListEnergy")),                  
                            "credentials"=>array(array('superadmin','admin','settings_app_domoprime_energy')),
                ), 
           
              "0060_domoprime_asset_model"=>array(
                    "title"=>"Asset models",                    
                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListAssetModel")),                                       
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_asset_model')),
                ), 
           
            "0070_domoprime_premeeting_model"=>array(
                    "title"=>"Pre meeting models",
                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListPreMeetingModel")),                  
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_premeting_model')),
                ), 
           
           
            "0080_domoprime_after_work_model"=>array(
                   "title"=>"After work models",
                   "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListAfterWorkModel")),                  
                   "credentials"=>array(array('superadmin','admin','settings_app_domoprime_afterwork_model')),
              ), 
           
            "0090_domoprime_billing_model"=>array(
                   "title"=>"Billing models",
                   "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListBillingModel")),                  
                   "credentials"=>array(array('superadmin','admin','settings_app_domoprime_billing_model')),
              ), 
           
            "0100_domoprime_quotation_model"=>array(
                  "title"=>"Quotation models",
                  "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListQuotationModel")),                  
                  "credentials"=>array(array('superadmin','admin','settings_app_domoprime_quotation_model')),
              ), 
           
           
            "0040_iso_configuration"=>array( 
                 "title"=>"ISO",    
                  "enabled"=>true,
                  "childs"=>array(
                      "030_app_domoprime_configuration_zone"=>null,    
                      "040_app_domoprime_configuration_energy"=>null,
                      "070_app_domoprime_configuration_class"=>null,
                      "080_app_domoprime_configuration_quotation_model"=>null,
                      "090_app_domoprime_configuration__billing_model"=>null,
                      "100_app_domoprime_configuration_asset_model"=>null,
                      "110_app_domoprime_configuration_polluting"=>null,
                      "120_app_domoprime_configuration_premeeting_model"=>null,
                      "140_site_domoprime_as_after_work_model"=>null,
                      "150_app_domoprime_configuration_settings"=>null,
                      "160_domoprime_configuration_documents"=>null,
                   )                   
               ),  
           
           
           "030_app_domoprime_configuration_zone"=>array(
                             "title"=>"Sectors",
                             "icon"=>"fa-list",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListZone")),                  
                             "picture"=>"/pictures/icons/sectors.png",
                             "help"=>"modify, add and delete status",        
                             "credentials"=>array(array('superadmin','admin',)),
                ), 
           
              "040_app_domoprime_configuration_energy"=>array(
                             "title"=>"Energy",
                             "icon"=>"fa-list",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListEnergy")),                  
                             "picture"=>"/module/app_domoprime/pictures/energy32x32.png",
                             "help"=>"modify, add and delete status",  
                            "credentials"=>array(array('superadmin','admin','settings_app_domoprime_energy')),
                ), 
           
             "070_app_domoprime_configuration_class"=>array(
                             "title"=>"Classes",
                             "icon"=>"fa-list",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListClass")),                  
                             "picture"=>"/pictures/icons/customer.png",
                             "help"=>"modify, add and delete status",   
                             "credentials"=>array(array('superadmin','admin','settings_app_domoprime_class')),
                ), 
           
             "080_app_domoprime_configuration_quotation_model"=>array(
                    "title"=>"Quotation models",
                   "icon"=>"fa-list",
                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListQuotationModel")),                  
                    "picture"=>"/pictures/icons/doc32x32.png",
                    "help"=>"modify, add and delete status", 
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_quotation_model')),
                    ), 
           
           
            "090_app_domoprime_configuration__billing_model"=>array(
                    "title"=>"Billing models",
                    "icon"=>"fa-list",
                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListBillingModel")),                  
                    "picture"=>"/pictures/icons/doc32x32.png",
                    "help"=>"modify, add and delete status", 
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_billing_model')),
                    ), 
           
           
             "100_app_domoprime_configuration_asset_model"=>array(
                    "title"=>"Asset models",
                    "icon"=>"fa-list",
                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListAssetModel")),                  
                    "picture"=>"/pictures/icons/doc32x32.png",
                    "help"=>"modify, add and delete status", 
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_asset_model')),
                    ), 
           
           
           "110_app_domoprime_configuration_polluting"=>array(
                             "title"=>"Pollutings",
                             "icon"=>"fa-list",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListPollutingCompany")),                  
                             "picture"=>"/pictures/icons/sav.jpg",
                             "help"=>"modify, add and delete status",
                             "credentials"=>array(array('superadmin','admin','settings_app_domoprime_polluters')),
                ),
           
             "120_app_domoprime_configuration_premeeting_model"=>array(
                    "title"=>"Pre meeting models",
                    "icon"=>"fa-list",
                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListPreMeetingModel")),                  
                    "picture"=>"/pictures/icons/doc32x32.png",
                    "help"=>"modify, add and delete status", 
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_premeting_model')),
                    ), 
           
           "140_site_domoprime_as_after_work_model"=>array(
                    "title"=>"After work models",
                    "icon"=>"fa-list",
                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListAfterWorkModel")),                  
                    "picture"=>"/pictures/icons/doc32x32.png",
                    "help"=>"modify, add and delete status", 
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_afterwork_model')),
                    ), 
           
            "150_app_domoprime_configuration_settings"=>array(
                             "title"=>"Settings",   
                             "icon"=>"fa-cog",
                             "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"Settings")),                  
                              "picture"=>"/pictures/icons/settings.png",
                             "help"=>"modify, add and delete status",  
                            "credentials"=>array(array('superadmin','admin','settings_app_domoprime_settings')),
                ), 
           
            "160_domoprime_configuration_documents"=>array(
                    "title"=>"Documents model class ISO",
                    "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListDocument")),                  
                    "credentials"=>array(array('superadmin','admin','settings_app_domoprime_documents')),
                ), 
           
             "0000_packboiler_config"=>array(                                            
                   "childs"=>array(
                       "0010_packboiler_polluting"=>null,  
                       "0030_packboiler_class"=>null,  
                       )                
               ),  
           
              "0010_packboiler_polluting"=>array(
                        "title"=>"Pollutings",
                        "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListPollutingCompany")),                  
                        "picture"=>"/pictures/icons/sav.jpg",
                        "help"=>"modify, add and delete status",
                        "credentials"=>array(array('superadmin','admin','settings_app_domoprime_polluters')),
                ),
           
           
             "0030_packboiler_class"=>array(
                        "title"=>"Classes",
                        "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListClass")),                  
                        "picture"=>"/pictures/icons/customer.png",
                        "help"=>"modify, add and delete status",   
                        "credentials"=>array(array('superadmin','admin','settings_app_domoprime_class')),
                ), 
           
           
           
           
              "meeting_quotations"=>array(
                        "title"=>"Meeting Quotations",
                        "route_ajax"=>array("app_domoprime_ajax"=>array("action"=>"ListPartialMeetingQuotation")),
                        "credentials"=>array(array('superadmin','admin','app_domoprime_quotation_list')),
                      //  "component"=>"/customers_schedule/tabCustomerMeetingSite",   
                ),     
        
           
    ),
);