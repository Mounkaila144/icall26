<?php


return array(


       "items"=>array(   // SITE MENU STRUCTURE 
           
                 "site_domoprime"=>array(
                 
                   "childs"=>array(  "30_partner_layer"=>null
                            ),           
                          
                 ), 
           
           	
				
		"30_partner_layer"=>array(
                             "title"=>"Partner layers",
                             "route_ajax"=>array("partners_layer_ajax"=>array("action"=>"ListLayerCompany")),                  
                             "picture"=>"/pictures/icons/sav.jpg",
                             "help"=>"modify, add and delete status",
                             "credentials"=>array(array('superadmin','admin','settings_partner_layer')),
                ),
           
           
           
               /* =============DASHBOARD3 MENU ============  */
           
             "0040_domoprime_settings_configuration"=>array(
                                                          
                  "childs"=>array(
                      "0010_partner_layer"=>null,                      
                   )                   
               ),  
            "0010_partner_layer"=>array(
                             "title"=>"Partner layers",
                             "icon"=>"fa-list",
                             "route_ajax"=>array("partners_layer_ajax"=>array("action"=>"ListLayerCompany")),                  
                             "picture"=>"/pictures/icons/sav.jpg",
                             "help"=>"modify, add and delete status",
                             "credentials"=>array(array('superadmin','admin','settings_partner_layer')),
                ),
           
           
           
              "0070_iso_configuration"=>array(                                        
                  "childs"=>array(
                      "0000_partner_layer"=>null,                      
                   )                   
               ),  
           		
		"0000_partner_layer"=>array(
                             "title"=>"Partner layers",
                             "icon"=>"fa-list",
                             "route_ajax"=>array("partners_layer_ajax"=>array("action"=>"ListLayerCompany")),                  
                             "picture"=>"/pictures/icons/sav.jpg",
                             "help"=>"modify, add and delete status",
                             "credentials"=>array(array('superadmin','admin','settings_partner_layer')),
                ),
           
            "0090_participants_configuration"=>array(                                           
                  "childs"=>array(
                      "0010_partner_layer"=>null,
                 
                   )
            ),
           
           "0010_partner_layer"=>array(
                             "title"=>"Partner layers",
                             "icon"=>"fa-list",
                             "route_ajax"=>array("partners_layer_ajax"=>array("action"=>"ListLayerCompany")),                  
                             "picture"=>"/pictures/icons/sav.jpg",
                             "help"=>"modify, add and delete status",
                             "credentials"=>array(array('superadmin','admin','settings_partner_layer')),
                ),
         ),                    
);