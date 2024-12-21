<?php

return array(

     "menu"=>array(                   
                    "site.dashboard"=>array(                                          
                        "childs"=>array('site_partners'=>''),                     
                    ),
                       
   ),
   
    
    "items"=>array(
      
        "site_partners"=>array(                  
                     "childs"=>array('site.partner.admin'=>''),    
                     "title"=>"Partners Administration",
                     "route_ajax"=>array('site_ajax'=>array('action'=>'Home')),
                     "enabled"=>true,                    
                 ),   
        
        "site.partner.admin"=>array(
                    "title"=>"Partners",
                    "route_ajax"=>array("partners_ajax"=>array("action"=>"ListPartner")),                  
                    "picture"=>"/pictures/icons/partner32x32.png",
                    "help"=>"modify, add and delete partner",                 
                    ),   
  ),
    
);