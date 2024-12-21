<?php

return array(
    
    // Tous les jours toutes les 10 mns
    "app_domoprime_iso"=>array(
        "title"=>"Update app domoprime iso cron",
        "minutes"=>"0,3,6,9,12,15,18,21,24,27,30,33,36,39,42,45,48,51,54,57",
        "hours"=>"*",
        "days"=>"*",
        "months"=>"*",
        "weekdays"=>"*",
        "task"=>"/app_domoprime_iso/update",
        "is_active"=>"NO"
    )
   
);