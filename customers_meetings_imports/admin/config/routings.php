<?php

return array(
    
    "customers_meeting_imports_ajax"=>array("pattern"=>'/module/site/customers/meeting/imports/admin/{action}',"module"=>"customers_meetings_imports","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
//    "customers_meeting_imports"=>array("pattern"=>'/module/site/customers/meeting/imports/admin/{action}',
//        "module"=>"customers_meetings_imports","action"=>"{action}","requirements"=>array("action"=>".*")),
    
    "customers_meeting_import_restrictive_access_log_file"=>array(
        "pattern"=>'/restrictive/data/meetings/imports/{import_file}/{log_file}',
        "requirements"=>array("import_file"=>"[0-9]*",
                              "log_file"=>".*",                                                          
                             ),
        "module"=>"customers_meetings_imports",                                   
        "action"=>"restrictiveAccessLogFile",
        "parameters"=>array("import_file"=>"{import_file}","log_file"=>"{log_file}")
    ),
);

