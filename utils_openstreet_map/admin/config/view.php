<?php
// key = [action][view]
return array('all'=>array('classView'=>'SmartyView',
    'widgets'=>array('messages'=>null,"banner"=>null),
),


    "_resources"=>array(

        "plugins"=>array(
            "widgets"=>array("javascripts"=>'',"stylesheets"=>''),
        ),

        "javascripts"=>array(
            "leaflet.js"=>array("module"=>"utils_openstreet_map"),

        ),
        'stylesheets'=>array(
            "leaflet.css"=>array("module"=>"utils_openstreet_map"),
        )
    ),
);
 
