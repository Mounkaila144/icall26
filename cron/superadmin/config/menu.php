<?php

return array(
    
     "menu"=>array(                   
                  
                    "dashboard_home"=>array(                     
                       "childs"=>array("dashboard_cron"=>null),                                 
                      ),
  ),
  "items"=>array(   
   
      
                 "dashboard_cron"=>array(
                    "component"=>"/cron/menuItem",     
                    "route_ajax"=>array('cron_ajax'=>array('action'=>'List')),
                    "picture"=>"/pictures/icons/cron.gif",
                    "help"=>"cron management",
                    "title"=>"Cron",
                    "credentials"=>array(),
                    "enabled"=>true,                    
                    ), 
      
                  
   ),   
    

);


