<?php

return array(

    
   
    
    "items"=>array(
      
        "site_products"=>array(                    
                 //    "childs"=>array('site.products.items.admin'=>''),                    
                 ),   
        
        "site.products.items.admin"=>array(
                    "title"=>"Product Items",
                    "route_ajax"=>array("products_items_ajax"=>array("action"=>"ListProduct")),                  
                    "picture"=>"/pictures/icons/item32x32.png",
                    "help"=>"modify, add and delete status",  
                    "credentials"=>array(array('superadmin','admin','settings_products_item')), 
                    ),   
        
       
  ),
    
);