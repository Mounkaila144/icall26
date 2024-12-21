<?php

return array(
     
    "items"=>array(                  
              
      "site_admin"=>array(                   
                     "childs"=>array("site_emulator"=>''),                   
                 ),   
     
      "site_emulator"=>array(
                    "title"=>"Emulator",
                    "route_ajax"=>array("site_emulator_ajax"=>array("action"=>"Emulator")),                  
                    "picture"=>"/pictures/icons/sectors.png",
                    "help"=>"modify, add and delete site languages",     
                    "credentials"=>array(array('superadmin','admin','settings_emulator')),
                ),           
  ),

);