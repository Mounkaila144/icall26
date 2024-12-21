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
                    ),   
  ),

);