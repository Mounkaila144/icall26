<?php

return array(

     "menu"=>array(                   
                    "site.dashboard"=>array(                                          
                        "childs"=>array('site_partners'=>''),                     
                    ),
                       
   ),
   
    
    "items"=>array(
      
        "site_partners"=>array(                  
                     "childs"=>array('site.partner.admin'=>'', "site.partners.settings.admin"=>''),    
                     "title"=>"Partners Administration",
                     "route_ajax"=>array('site_ajax'=>array('action'=>'Home')),
                     "enabled"=>true,      
                     "credentials"=>array(array('superadmin','admin','settings_partners')), 
                 ),   
        
        "site.partner.admin"=>array(
                    "title"=>"Conf Partners",
                    "route_ajax"=>array("partners_ajax"=>array("action"=>"ListPartner")),                  
                    "picture"=>"/pictures/icons/partner32x32.png",
                    "help"=>"modify, add and delete partner",                 
                    ),   
        
          "site.partners.settings.admin"=>array(
                    "title"=>"Settings partners",
                    "route_ajax"=>array("partners_ajax"=>array("action"=>"Settings")),                  
                    "picture"=>"/pictures/icons/settings.png",
                    "help"=>"modify, add and delete status", 
                    "credentials"=>array(array('superadmin','admin','settings_partner_settings')),
    ),
        
       /* =============DASHBOARD3 MENU ============  */

        "0050_partners_configuration"=>array(                  
                   "childs"=>array(
                       "0000_site.partners.settings.admin"=>null, 
                       "0010_site.partner.admin"=>null, 
                                  )             
           ), 
    
       "0000_site.partners.settings.admin"=>array(
                    "title"=>"Settings",
                    "route_ajax"=>array("partners_ajax"=>array("action"=>"Settings")),                  
                    "picture"=>"/pictures/icons/settings.png",
                    "help"=>"modify, add and delete status", 
                    "credentials"=>array(array('superadmin','admin','settings_partner_settings')),      
           ),
        
         "0010_site.partner.admin"=>array(
                    "title"=>"Partners",
                    "route_ajax"=>array("partners_ajax"=>array("action"=>"ListPartner")),                  
                    "picture"=>"/pictures/icons/partner32x32.png",
                    "help"=>"modify, add and delete partner",                 
                    ),  
        
           "0150_dashboard_configuration"=>array(                  
                   "childs"=>array(
                       "0150_partners_configuration"=>null, 
                    
                                  )             
           ), 
         "0150_partners_configuration"=>array( 
               "title"=>"Installers Administration",                                            
                   "enabled"=>true,
                   "childs"=>array(
                       "0000_site_partners_settings_admin"=>null, 
                       "0010_site_partner_admin"=>null
                    
                                  )             
           ), 
        
         "0000_site_partners_settings_admin"=>array(
                    "title"=>"Settings",
                    "route_ajax"=>array("partners_ajax"=>array("action"=>"Settings")),                  
                    "picture"=>"/pictures/icons/settings.png",
                    "help"=>"modify, add and delete status", 
                    "credentials"=>array(array('superadmin','admin','settings_partner_settings')),
    ),
        
        
         "0010_site_partner_admin"=>array(
                    "title"=>"Partners",
                    "route_ajax"=>array("partners_ajax"=>array("action"=>"ListPartner")),                  
                    "picture"=>"/pictures/icons/partner32x32.png",
                    "help"=>"modify, add and delete partner",                 
                    ),   
        
  ),
    
);