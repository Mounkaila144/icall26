<?php

return array(
    
    "dashboard.home"=>array(
             
                "dashboard-site-services"=>array(
                                    "title"=>"Servers",
                                  //  "help"=>"help sites",
                                 //   "route"=>array("site_ajax"=>array("action"=>"ListPartial")),
                                    "credentials"=>array(array('superadmin')),
                                    "picture"=>"/pictures/icons/server132x32.png",  
                                    "component"=>"/site_services/tabsDashboardServers",   
                ), 
      
    ),

   "dashboard-site-services"=>array(
            "site_services_sites"=>array(
                        "title"=>"Sites",     
                        "credentials"=>array(array('superadmin')),                
                        "component"=>"/site_services/TabServicesSites",     
             ),
       
              "site_services_servers"=>array(
                        "title"=>"Servers",      
                        "credentials"=>array(array('superadmin')),
                        "component"=>"/site_services/TabServicesServers",     
             ),

       ),
);