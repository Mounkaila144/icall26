<?php

return array(

    
   
    
    "items"=>array(
      
        "site_products"=>array(                    
                     "childs"=>array('site.products.admin'=>'',"site.products.tax"=>'',"site.products.settings"=>'', "site.products.actions"=>''),                    
                 ),   
        
        "site.products.admin"=>array(
                    "title"=>"Conf products",
                    "route_ajax"=>array("products_ajax"=>array("action"=>"ListProduct")),                  
                    "picture"=>"/pictures/icons/product.png",
                    "help"=>"modify, add and delete status",  
                    "credentials"=>array(array('superadmin','admin','settings_products')), 
                    ),   
        
        "site.products.tax"=>array(
                    "title"=>"Taxes",
                    "route_ajax"=>array("products_ajax"=>array("action"=>"ListTaxes")),                  
                    "picture"=>"/pictures/icons/tax.png",
                    "help"=>"modify, add and delete status",     
                    "credentials"=>array(array('superadmin','admin','settings_taxes')), 
                    ), 
        
         "site.products.settings"=>array(
                    "title"=>"Settings default products",
                    "route_ajax"=>array("products_ajax"=>array("action"=>"SettingsProduct")),                  
                    "picture"=>"/pictures/icons/settings.png",
                    "help"=>"modify, add and delete settings",    
                    "credentials"=>array(array('superadmin','admin','settings_products_settings')),
                    ), 
        
           "site.products.actions"=>array(
                    "title"=>"Actions",
                    "route_ajax"=>array("products_ajax"=>array("action"=>"ListAction")),                  
                    "picture"=>"/pictures/icons/action32x32.png",
                    "help"=>"modify, add and delete status",       
                    "credentials"=>array(array('superadmin','settings_products_actions')), 
                    ), 
        
       /* =============DASHBOARD MENU ============  */
            
          "90_configuration"=>array(         
                   "childs"=>array(
                       "700_products_configuration"=>null
                   )
               ), 
           
           "700_products_configuration"=>array(
                "title"=>"Products",                                            
                "enabled"=>true,
                "childs"=>array("100_products_configuration_products_admin"=>null,
                                "200_products_configuration_products_tax"=>null,
                                "300_products_configuration_products_actions"=>null,
                                "900_products_configuration_products_settings"=>null,
                             ),
           ),
        
           "100_products_configuration_products_admin"=>array(
                "title"=>"Products",                                            
                "route_ajax"=>array("products_ajax"=>array("action"=>"ListProduct")),                                   
                "credentials"=>array(array('superadmin','admin','settings_products')), 
           ),
                  
        
          "200_products_configuration_products_tax"=>array(
                    "title"=>"Taxes",
                    "route_ajax"=>array("products_ajax"=>array("action"=>"ListTaxes")),                                  
                    "credentials"=>array(array('superadmin','admin','settings_taxes')), 
                    ), 
        
          "300_products_configuration_products_actions"=>array(
                    "title"=>"Actions",
                    "route_ajax"=>array("products_ajax"=>array("action"=>"ListAction")),                                      
                    "credentials"=>array(array('superadmin','settings_products_actions')), 
                    ), 
        
        
         "900_products_configuration_products_settings"=>array(
                    "title"=>"Settings",
                    "route_ajax"=>array("products_ajax"=>array("action"=>"SettingsProduct")),                  
                    "picture"=>"/pictures/icons/settings_png",
                    "help"=>"modify, add and delete settings",    
                    "credentials"=>array(array('superadmin','admin','settings_products_settings')),
                    ), 
                 
         /* =============DASHBOARD3 MENU ============  */
          "0080_dashboard_customers_configuration"=>array( 
              
                   "childs"=>array(
                       "0070_products_admin_configuration"=>null, 
                                  )             
           ), 
         "0070_products_admin_configuration"=>array( 
                 "title"=>"Product administration",
                 "icon"=>"fa-list",
                   "childs"=>array(
                       "0000_products_configuration_products_admin"=>null, 
                                  )             
           ), 
    
         "0000_products_configuration_products_admin"=>array(
                    "title"=>"Products",
                    "route_ajax"=>array("products_ajax"=>array("action"=>"ListProduct")),                  
                    "picture"=>"/pictures/icons/product.png",
                    "help"=>"modify, add and delete status",  
                    "credentials"=>array(array('superadmin','admin','settings_products')), 
                    ),   
        
          "0150_dashboard_configuration"=>array(               
                   "childs"=>array(
                       "0170_products_configuration"=>null, 
                    
                                  )             
           ), 

         "0170_products_configuration"=>array( 
               "title"=>"Products",                                            
                   "enabled"=>true,
                   "childs"=>array(
                       "0000_products_configuration_products_admin"=>null, 
                       "0020_products_configuration_products_tax"=>null,
                       "0030_products_configuration_products_actions"=>null,
                       "0050_products_configuration_products_settings"=>null
                                  )             
           ), 
        
        
          "0000_products_configuration_products_admin"=>array(
                    "title"=>"Products",
                    "route_ajax"=>array("products_ajax"=>array("action"=>"ListProduct")),                  
                    "picture"=>"/pictures/icons/product.png",
                    "help"=>"modify, add and delete status",  
                    "credentials"=>array(array('superadmin','admin','settings_products')), 
                    ),   
        
        
          "0020_products_configuration_products_tax"=>array(
                    "title"=>"Taxes",
                    "route_ajax"=>array("products_ajax"=>array("action"=>"ListTaxes")),                  
                    "picture"=>"/pictures/icons/tax.png",
                    "help"=>"modify, add and delete status",     
                    "credentials"=>array(array('superadmin','admin','settings_taxes')), 
                    ), 
        
     
        
           "0030_products_configuration_products_actions"=>array(
                    "title"=>"Actions",
                    "route_ajax"=>array("products_ajax"=>array("action"=>"ListAction")),                  
                    "picture"=>"/pictures/icons/action32x32.png",
                    "help"=>"modify, add and delete status",       
                    "credentials"=>array(array('superadmin','settings_products_actions')), 
                    ), 
        
            "0050_products_configuration_products_settings"=>array(
                    "title"=>"Settings",
                    "route_ajax"=>array("products_ajax"=>array("action"=>"SettingsProduct")),                  
                    "picture"=>"/pictures/icons/settings.png",
                    "help"=>"modify, add and delete settings",    
                    "credentials"=>array(array('superadmin','admin','settings_products_settings')),
                    ), 
  ),
    
);