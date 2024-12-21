<?php

return array(
      
    
    "items"=>array(
      
        "site_products"=>array(                    
                     "childs"=>array('site.products.admin'=>'',"site.products.tax"=>'',
                                     "site.products.settings"=>'',
                                     "site.products.actions"=>''),                    
                 ),   
        
        "site.products.admin"=>array(
                    "title"=>"Products Administration",
                    "route_ajax"=>array("products_ajax"=>array("action"=>"ListProduct")),                  
                    "picture"=>"/pictures/icons/product.png",
                    "help"=>"modify, add and delete status",                 
                    ),   
        
        "site.products.tax"=>array(
                    "title"=>"Taxes",
                    "route_ajax"=>array("products_ajax"=>array("action"=>"ListTaxes")),                  
                    "picture"=>"/pictures/icons/tax.png",
                    "help"=>"modify, add and delete status",                 
                    ), 
        
         "site.products.settings"=>array(
                    "title"=>"Settings",
                    "route_ajax"=>array("products_ajax"=>array("action"=>"SettingsProduct")),                  
                    "picture"=>"/pictures/icons/settings.png",
                    "help"=>"modify, add and delete settings",                 
                    ), 
        
         "site.products.actions"=>array(
                    "title"=>"Actions",
                    "route_ajax"=>array("products_ajax"=>array("action"=>"ListAction")),                  
                    "picture"=>"/pictures/icons/action32x32.png",
                    "help"=>"modify, add and delete status",                 
                    ), 
  ),
    
);