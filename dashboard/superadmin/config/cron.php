<?php

return array(
    //"0 0 * * 0 => @weekly  
    
 "dashboard_remove_log"=>array(
        
        "title"=>"Remove logs",
        "minutes"=>"0",
        "hours"=>"0",
        "days"=>"*",
        "months"=>"*",
        "weekdays"=>"0",  // Sunday
       
        "is_active"=>"NO",        
        "task"=>"/dashboard/process",
    ),
);