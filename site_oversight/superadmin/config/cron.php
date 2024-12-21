<?php

return array(
    
    "site_oversight_cron"=>array(
        
        "title"=>"Process site oversight",
        "minutes"=>"0,5,10,15,20,25,30,35,40,45,50,55",
        "hours"=>"*",
        "days"=>"*",
        "months"=>"*",
        "weekdays"=>"*",
       
        "task"=>"/site_oversight/process",
    ),
    
    
     "site_oversight_email_cron"=>array(
        
        "title"=>"Process site oversight email sending",
        "minutes"=>"0,5,10,15,20,25,30,35,40,45,50,55",
        "hours"=>"*",
        "days"=>"*",
        "months"=>"*",
        "weekdays"=>"*",
       
        "task"=>"/site_oversight/sendalert",
    ),
    
    
);