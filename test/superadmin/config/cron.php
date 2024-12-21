<?php

return array(
    
    "test_copy_menu_cron"=>array(
        
        "title"=>"Copy menu files",
        "minutes"=>"*",
        "hours"=>"*",
        "days"=>"*",
        "months"=>"*",
        "weekdays"=>"*",
       
        "task"=>"/test/copyMenu",
    ),
    
    "test_restore_menu_cron"=>array(
        
        "title"=>"Copy menu files",
        "minutes"=>"*",
        "hours"=>"*",
        "days"=>"*",
        "months"=>"*",
        "weekdays"=>"*",
       
        "task"=>"/test/restoreMenu",
    ),
    
);