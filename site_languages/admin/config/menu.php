<?php

return array(
  "items"=>array(   
     
      
        "site_admin"=>array(                     
                   "childs"=>array("site_languages"=>''),
                 ), 
           
       "site_languages"=>array(
                    "title"=>"languages",                   
                    "route_ajax"=>array("languages_ajax"=>array("action"=>"List")), 
                    "picture"=>"/pictures/icons/languages.png",
                    "help"=>"languages administration",
                    "credentials"=>array(array('superadmin','admin','settings_languages')),
                    "enabled"=>true,               
        ), 
   ),
);