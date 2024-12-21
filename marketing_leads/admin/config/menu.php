<?php


    
return array(
  "menu"=>array(                   
                        
           
            "Dashboard"=>array(                                            
                "childs"=>array('10_marketing_leads'=>''),                    
            ), 
           
       ),
    "items"=>array(
        
        "site_marketing_leads"=>array(
            "title"=>"Marketing leads",                  
            "route_ajax"=>array('site_ajax'=>array('action'=>'Home')),
            "enabled"=>true,
            "childs"=>array("site_marketing_leads.00_landing_page_site"=>null,
                            "site_marketing_leads.50_import"=>null,
                            "site_marketing_leads.60_status"=>null,
//                            "site_marketing_leads.90_settings"=>null,
            ),           
            "credentials"=>array(array('superadmin','admin','marketing_leads')),
        ), 
        
        "site_marketing_leads.00_landing_page_site"=>array(
            "title"=>"Sites",
            "route_ajax"=>array("marketing_leads_ajax"=>array("action"=>"ListWpLandingPageSite")),                  
            "picture"=>"/module/marketing_leads/pictures/translation.png",
            "help"=>"modify, add and delete status",        
            "credentials"=>array(array('superadmin','admin','marketing_leads_landing_page_site_list')),
        ), 
        
        "site_marketing_leads.50_import"=>array(
            "title"=>"Import",
            "route_ajax"=>array("marketing_leads_ajax"=>array("action"=>"ListFiles")),                  
            "picture"=>"/pictures/icons/import32x32.png",
            "enable"=>false,
            "help"=>"modify, add and delete status",        
            "credentials"=>array(array('superadmin','admin','marketing_leads_import')),
        ), 
        
        "site_marketing_leads.60_status"=>array(
            "title"=>"Leads Status",  
            "route_ajax"=>array("marketing_leads_ajax"=>array("action"=>"ListStatus")),                  
            "picture"=>"/pictures/icons/status32x32.png",
            "help"=>"modify, add and delete status",        
            "credentials"=>array(array('superadmin','admin','marketing_leads_status')),
        ),   
        
        
          /*====================DASHBOARD MENU=================*/
           
            "10_marketing_leads"=>array(
                "title"=>"Contacts",
                 "route_ajax"=>array("marketing_leads_ajax"=>array("action"=>"ListWpFormsAll")),                                                       
                 "credentials"=>array(array('superadmin','admin','marketing_leads_contacts'))

               ), 
        
        
        
        
          "90_configuration"=>array(
         
                   "childs"=>array("0000_marketing_leads_config"=>null)                
               ),  
          
        
          "0000_marketing_leads_config"=>array(
                  "title"=>"Marketing leads",                                                 
                     "childs"=>array("100_site_marketing_leads_status"=>null,
                                     "200_site_marketing_leads_files"=>null,
                                     "300_site_marketing_leads_landing_page_site"=>null,
                                     
                        )
                       
               ), 
           "100_site_marketing_leads_status"=>array(
                  "title"=>"Leads Status",  
                    "route_ajax"=>array("marketing_leads_ajax"=>array("action"=>"ListStatus")),                      
                    "credentials"=>array(array('superadmin','admin','marketing_leads_status')),
                    ), 
        
        
            "200_site_marketing_leads_files"=>array(
                 "title"=>"Import",
                 "route_ajax"=>array("marketing_leads_ajax"=>array("action"=>"ListFiles")),                     
                 "credentials"=>array(array('superadmin','admin','marketing_leads_import')),
             ), 
        
          "300_site_marketing_leads_landing_page_site"=>array(
                "title"=>"Sites",
                "route_ajax"=>array("marketing_leads_ajax"=>array("action"=>"ListWpLandingPageSite")),                          
                "credentials"=>array(array('superadmin','admin','marketing_leads_landing_page_site_list')),
        ), 
                                 
    ),                    
    
);