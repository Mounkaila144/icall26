<?php

return array(
     
    "items"=>array(                  
              
      "site_admin"=>array(                   
                     "childs"=>array("site_company"=>''),                   
                 ),   
     
      "site_company"=>array(
                    "title"=>"Company",
                    "route_ajax"=>array("site_company_ajax"=>array("action"=>"View")),                  
                    "picture"=>"/pictures/icons/company.png",
                    "help"=>"modify, add and delete site languages",     
                    "credentials"=>array(array('superadmin','admin','settings_company')),
                    ),   
        
        
         /* =============DASHBOARD TAB => MENU ============  */      
     
      "80_site_configuration"=>array(                              
                   "childs"=>array( "40_site_configuration_site_company"=>null
                        )
               ), 
     
      "40_site_configuration_site_company"=>array(
                    "title"=>"Company",
                    "route_ajax"=>array("site_company_ajax"=>array("action"=>"View")),                                     
                    "credentials"=>array(array('superadmin','admin','settings_company')),
                     "enabled"=>true,
                           
                 ), 
        
          /* =============DASHBOARD3 MENU ============  */
          
      "0000_site_admin_configuration"=>array(                              
                   "childs"=>array( "0010_site_configuration_site_company"=>null
                        )
               ),
        
          "0010_site_admin_configuration"=>array(                  
                   "childs"=>array(
                       "0010_site_configuration_site_company"=>null, 
                                  )             
           ), 
     
     "0010_site_configuration_site_company"=>array(
                    "title"=>"Company",
                    "icon"=>"fa-home",
                    "picture"=>"/pictures/icons/company.png",
                    "route_ajax"=>array("site_company_ajax"=>array("action"=>"View")),                                     
                    "credentials"=>array(array('superadmin','admin','settings_company')),
                     "enabled"=>true,
                           
                 ), 
  ),

);