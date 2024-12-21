<?php

return array(
     
    "items"=>array(                  
              
      "site_admin"=>array(                   
                     "childs"=>array("site_text"=>''),                   
                 ),   
     
        
      "site_text"=>array(
                    "title"=>"Texts",
                    "route_ajax"=>array("site_text_ajax"=>array("action"=>"ListText")),                  
                    "picture"=>"/pictures/icons/pictures32x32.png",                 
                    "credentials"=>array(array('superadmin','admin','settings_text')),
                    ),   
  ),

);