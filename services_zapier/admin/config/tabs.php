<?php

return array(
    
    "dashboard.site"=>array(

        "dashboard-x-list-client" => array(
            "title" => "Auth2.0 Client New",
            "route"=>array("services_zapier_ajax"=>array("action"=>"ListPartialClient")),
            "credentials"=>array(array('superadmin','services_zapier_client')),
        ),
        "dashboard-x-list-merge" => array(
            "title" => "Merge ",
            "route"=>array("services_zapier_ajax"=>array("action"=>"Merge")),
            "credentials"=>array(array('superadmin','services_zapier_client')),
        ),
    
   
 ),
  
);