<?php

return array(
    
 

   "dashboard.site"=>array(
             
                "dashboard-x-settings"=>array(
                                    "title"=>"Settings",
                                    "help"=>"help download",
                                    "icon"=>"cog",
                                //    "route"=>array("site_ajax"=>array("action"=>"Admin")),
                                    "picture"=>"/pictures/icons/system.png",  
                                    "component"=>"/site/menuDashboard",   
                                    "credentials"=>array(array('superadmin','settings')),
                ), 
      
    ),
);