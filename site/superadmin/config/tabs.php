<?php

return array(
    
    "dashboard.home"=>array(
             
                "dashboard-site"=>array(
                                    "title"=>"sites",
                                    "help"=>"help sites",
                                 //   "route"=>array("site_ajax"=>array("action"=>"ListPartial")),
                                    "picture"=>"/pictures/icons/website.png",  
                                    "component"=>"/site/tabsDashboardSites",   
                         "credentials"=>array(array('superadmin')),
                ), 
      
    ),

   "dashboard.site"=>array(
             
                "dashboard-site-x-settings"=>array(
                                    "title"=>"Settings",
                                    "help"=>"help download",
                                    "icon"=>"cog",
                               //     "route"=>array("site_ajax"=>array("action"=>"Admin")),
                                    "picture"=>"/pictures/icons/system.png",  
                                    "component"=>"/site/menuDashboardSite",   
                                    "credentials"=>array(array('superadmin')),
                ), 
      
    ),
);