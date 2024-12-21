<?php

return array(

    "items" => array(
        "site_services"=>array(
            "childs"=>array("google_sheet_setting"=>null
            ),
        ),

        "google_sheet_setting" => array(
            "title" =>"Setting Google Sheet",
            "picture"=>"/pictures/icons/sheets.png",
            "route_ajax"=>array("utils_google_sheet_ajax"=>array("action"=>"Settings")),
            "credentials"=>array(array('superadmin','util_google_sheet_setting')),
        ),



    )

);
