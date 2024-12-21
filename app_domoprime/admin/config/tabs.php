<?php

return array(
    
    "dashboard.site"=>array(
             
                "dashboard-customers-meeting-app-domoprime-00"=>array(
                                    "title"=>"Cumac",
                                  //  "route"=>array(""=>array()),
                                    "icon"=>"table",
                                    "route"=>array("app_domoprime_ajax"=>array("action"=>"ListPartialCalculation")),
                                    "help"=>"help download",
                                    "picture"=>"/pictures/icons/meeting.png",  
                                    "credentials"=>array(array('superadmin','admin','app_domoprime_calculation')),
                                  //  "component"=>"/customers_schedule/tabCustomerMeetingSite",   
                ), 
        
                 "dashboard-customers-meeting-app-domoprime-10-quotations"=>array(
                                    "title"=>"Quotations",
                                  //  "route"=>array(""=>array()),
                                    "icon"=>"table",
                                    "route"=>array("app_domoprime_ajax"=>array("action"=>"ListPartialQuotation")),
                                  //  "help"=>"help download",
                                    "picture"=>"/pictures/icons/meeting.png",  
                                    "credentials"=>array(array('superadmin','admin','app_domoprime_quotation_list')),
                                  //  "component"=>"/customers_schedule/tabCustomerMeetingSite",   
                ),       
        
                "dashboard-customers-meeting-app-domoprime-11-meeting-quotations"=>array(
                                    "title"=>"Meeting Quotations",
                                  //  "route"=>array(""=>array()),
                                    "icon"=>"table",
                                    "route"=>array("app_domoprime_ajax"=>array("action"=>"ListPartialMeetingQuotation")),
                                  //  "help"=>"help download",
                                    "picture"=>"/pictures/icons/meeting.png",  
                                    "credentials"=>array(array('superadmin','admin','app_domoprime_quotation_list')),
                                  //  "component"=>"/customers_schedule/tabCustomerMeetingSite",   
                ),     
        
                  "dashboard-customers-meeting-app-domoprime-20-billings"=>array(
                                    "title"=>"Billings",
                                  //  "route"=>array(""=>array()),
                                    "icon"=>"table",
                                    "route"=>array("app_domoprime_ajax"=>array("action"=>"ListPartialBilling")),
                                    "help"=>"help download",
                                    "picture"=>"/pictures/icons/meeting.png",  
                                    "credentials"=>array(array('superadmin','admin','app_domoprime_billing_list')),
                                  //  "component"=>"/customers_schedule/tabCustomerMeetingSite",   
                ), 
                
                   "dashboard-customers-meeting-app-domoprime-22-assets"=>array(
                                    "title"=>"Assets",
                                  //  "route"=>array(""=>array()),
                                    "icon"=>"table",
                                    "route"=>array("app_domoprime_ajax"=>array("action"=>"ListPartialAsset")),
                                   // "help"=>"help download",
                                   // "picture"=>"/pictures/icons/meeting.png",  
                                    "credentials"=>array(array('superadmin','admin','app_domoprime_asset_list')),
                                  //  "component"=>"/customers_schedule/tabCustomerMeetingSite",   
                ), 
        
               "dashboard-customers-meeting-app-domoprime-25-report"=>array(
                                    "title"=>"Cumac Report",
                                  //  "route"=>array(""=>array()),
                                    "icon"=>"table",
                                    "route"=>array("app_domoprime_ajax"=>array("action"=>"Report")),
                                    "help"=>"help download",
                                    "picture"=>"/pictures/icons/meeting.png",  
                                    "credentials"=>array(array('superadmin','admin','domoprime_report')),                                   
                ), 
        
        
         "dashboard-statistics-app-domoprime-operation"=>array(
                                    "title"=>"Operation Accounts",
                                    "icon"=>"area-chart",
                                 //   "help"=>"help download",
                                    "picture"=>"/pictures/icons/system.png",  
                                    "route"=>array("app_domoprime_ajax"=>array("action"=>"StatisticOperations")),
                                    "credentials"=>array(array('superadmin','domoprime_statistics_operations')),
                                 //   "component"=>"/site_statistics/tab",   
                ), 
    ),
                
   "dashboard-site-customers-contract-multiple"=> array(        
             "30-app-domoprime-contract-multiple"=>array(
                        "title"=>"Mutiple", 
                        "component"=>"/app_domoprime/tabMultiple",     
             ),
                 
   ),
    
   "dashboard-site-customers-contract-multiple-others"=> array(        
             "30-app-domoprime-contract-multiple-others"=>array(
                        "title"=>"Mutiple", 
                        "component"=>"/app_domoprime/OtherTabMultiple",     
             ),
                 
   ),
    
    
   "dashboard-site-customers-contract-multiple-batch"=> array(        
             "30-app-domoprime-contract-multiple-batch"=>array(
                        "title"=>"Mutiple", 
                        "component"=>"/app_domoprime/BatchTabMultiple",     
             ),
                 
   ),
    
    'dashboard-site-customers-contract-documents-export-multiple'=>array(
       "app-domoprime-documents"=>array(                                                                 
                                    "component"=>"/app_domoprime/TabItemForDocumentExport",     
                                    "credentials"=>array()
                         ),
  ),
    
    
   "dashboard-site-customers-contract-exports-dictionary"=>array(
             "30-app-domoprime-export-dictionary"=>array(
                        "title"=>"Information",                      
                        "component"=>"/app_domoprime/dictionaryTabInformation",     
             ), 
            "35-app-domoprime-export-engine5-dictionary"=>array(
                        "title"=>"Quotation",                      
                        "component"=>"/app_domoprime/dictionary5TabInformation", 
                        "credentials"=>array(array('superadmin','contract_export_dictionary_quotation_engine5'))
             ),                  
   ),     
     
);
