<?php

return array(

    "items" => array(
        "site_services"=>array(
            "childs"=>array("services_zapier_setting"=>null
            ),
        ),

        "services_zapier_setting" => array(
            "title" =>"Setting Auth2.0 Zapier",
            //"picture"=>"/pictures/icons/sheets.png",
            "route_ajax"=>array("services_zapier_ajax"=>array("action"=>"Settings")),
            "credentials"=>array(array('superadmin','admin','services_zapier_setting')),
        ),



    )

);
