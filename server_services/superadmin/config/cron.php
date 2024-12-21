<?php

return array(
    
    // Tous les jours toutes les 10 mns
    "server_services_cron"=>array(
        "title"=>"Update server services cron.",
        "minutes"=>"0",
        "hours"=>"1-23",
        "days"=>"*",
        "months"=>"*",
        "weekdays"=>"*",
        "task"=>"/server_services/update",
        "is_active"=>"NO"
    )
   
);