<?php

return array(
    
          "menu"=>array(                   
                        "site.dashboard"=>array(                                            
                            "childs"=>array('site_services'=>'',
                                            "site_works"=>'',
                                            "site_documents"=>'',
                                            'site_marketing_leads'=>''),                    
                        ), 
              
                        "Dashboard"=>array(                                            
                            "childs"=>array(
                                "30_schedules"=>'',
                                "75_communications"=>'',
                                "77_documents"=>"",
                                "79_accounting"=>'',
                                "90_configuration"=>''),                    
                        ), 
              
              
                         "Dashboard2"=>array(                                            
                            "childs"=>array(
                                "30_schedules"=>'',
                                "75_communications"=>'',
                                "77_documents"=>"",
                                "79_accounting"=>'',
                                "90a_configuration"=>''
                                ),                    
                        ), 
              
                        "Dashboard3"=>array(                                            
                            "childs"=>array(
                                "0080_dashboard_customers_configuration"=>null,  
                                 "0150_dashboard_configuration"=>null,
                                ),                    
                        ), 
       ),
      
       "items"=>array(   // SITE MENU STRUCTURE 
           
                "site_services"=>array(
                   "title"=>"Services",                  
                   "route_ajax"=>array('site_ajax'=>array('action'=>'Home')),
                   "enabled"=>true,                                
                 ),
           
           
                  "site_works"=>array(
                   "title"=>"Batch",                  
                   "route_ajax"=>array('site_ajax'=>array('action'=>'Home')),
                   "enabled"=>true,                                
                 ),
           
            "site_documents"=>array(
                   "title"=>"Documents",                  
                   "route_ajax"=>array('site_ajax'=>array('action'=>'Home')),
                   "enabled"=>true,                                
                 ),
           
           
      "site_marketing_leads"=>array(
            "title"=>"Marketing leads",                  
            "route_ajax"=>array('site_ajax'=>array('action'=>'Home')),
            "enabled"=>true,
            "childs"=>array(),           
            "credentials"=>array(array('superadmin','admin','marketing_leads')),
        ), 
           
           
           
             /* =============DASHBOARD MENU ============  */
           
            "30_schedules"=>array(
                   "title"=>"Schedules",                                            
                   "enabled"=>true,
                   "component"=>"/dashboard/DashboardSchedulesMenuItem" ,
                   "credentials"=>array(array('menu_onglet_planning','superadmin')),                
               ),  
           
            "90_configuration"=>array(
                   "title"=>"Configurations",                                            
                   "enabled"=>true,
                   "component"=>"/dashboard/DashboardMenuItem",
                   "childs"=>array(
                       "800_services_configuration"=>null,
                       "900_menu_configuration"=>null
                   ),
                 "credentials"=>array(array('menu_configuration_utilisateur','menu_configuration_admin','superadmin')),
               ),  
           
             "75_communications"=>array(
                   "title"=>"Communications",                                            
                   "enabled"=>true,
                   "component"=>"/dashboard/DashboardCommunicationsMenuItem" ,
                  "credentials"=>array(array('menu_onglet_communications','superadmin')),
               ),  
           
           
            "77_documents"=>array(
                   "title"=>"Documents",                                            
                   "enabled"=>true,
                   "component"=>"/dashboard/DashboardDocumentsMenuItem",
                 "credentials"=>array(array('menu_onglet_comptabilite','superadmin')),
               ),  
           
            "79_accounting"=>array(
                   "title"=>"Accounting",                                            
                   "enabled"=>true,
                   "component"=>"/dashboard/DashboardAccountingMenuItem"                 
               ),  
           
           
           "800_services_configuration"=>array(
                "title"=>"Services",                                            
                "enabled"=>true,
           ),
           
           
           
           /* =============DASHBOARD2 MENU ============  */
                     
            "90a_configuration"=>array(
                   "title"=>"Configurations",                                            
                   "enabled"=>true,
                 //  "component"=>"/dashboard/DashboardMenuItem",
                   
               ), 
           
           
           /* =============DASHBOARD3 MENU ============  */
                     
            "0080_dashboard_customers_configuration"=>array(
                  "title"=>"Customers Config.",                                            
                  "childs"=>array(
                     "0080_documents_configuration"=>null,
                   )
                   
               ),  
            
               "0080_documents_configuration"=>array(
                   "title"=>"Documents",                                            
                   "enabled"=>true,
                              
               ),  
           
           
           "0150_dashboard_configuration"=>array(
                "title"=>"Configurations",                                            
                   "enabled"=>true,                   
           ),
		   
		    "site_admin"=>array(                   
                    "childs"=>array("dashboard_tab"=>'',"dashboard_menu"=>''),                   
                ),
           
            "dashboard_tab"=>array(
                 "title"=>"List of tabs",
                 "route_ajax"=>array("dashboard_ajax"=>array("action"=>"PositionTab")),                  
                 "picture"=>"/pictures/icons/type32x32.png",
                 "credentials"=>array(array('superadmin','admin','settings_dashboard_tab')),
            ),
           
            "dashboard_menu"=>array(
                 "title"=>"List of menus",
                 "route_ajax"=>array("dashboard_ajax"=>array("action"=>"ListMenu")),                  
                 "picture"=>"/pictures/icons/type32x32.png",
                 "credentials"=>array(array('superadmin','admin')),
            ),
           
           
            "900_menu_configuration"=>array(
                "title"=>"Menu",              
                "childs"=>array("0001_menu_manager"=>"")
           ),
           
          
        
         "0001_menu_manager"=>array(
              "title"=>"menu manager",
               "route_ajax"=>array("dashboard_ajax"=>array("action"=>"ListMenu")),                  
               
                 "credentials"=>array(array('superadmin','admin')),                             
         ),    
         
           /*======================DASHBOARD=========================*/
           "80_site_configuration"=>array(
                "childs"=>array(
                    "0000_dashboard_tab"=>null,
                )                 
           ),
    
     
          "0000_dashboard_tab"=>array(
                 "title"=>"List of tabs",
                 "route_ajax"=>array("dashboard_ajax"=>array("action"=>"PositionTab")),                  
                 "picture"=>"/pictures/icons/type32x32.png",
                 "credentials"=>array(array('superadmin','admin','settings_dashboard_tab')),
            ),
           
    ),
);

