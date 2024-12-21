<?php

return array(
    
    "marketing_leads_ajax"=>array("pattern"=>'/module/marketing/leads/admin/{action}',
        "module"=>"marketing_leads","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
    "marketing_leads"=>array("pattern"=>'/module/marketing/leads/{action}',
        "module"=>"marketing_leads","action"=>"{action}","requirements"=>array("action"=>".*")),
    
    "marketing_leads_test"=>array("pattern"=>'/marketing/leads/test',
                        "module"=>"marketing_leads",
                        "action"=>"ajaxTest"
    ),
    
    "marketing_leads_import_restrictive_access_log_file"=>array(
        "pattern"=>'/restrictive/data/marketing/leads/imports/{import_file}/{log_file}',
        "requirements"=>array("import_file"=>"[0-9]*",
                              "log_file"=>".*",                                                          
                            ),
        "module"=>"marketing_leads",                                   
        "action"=>"restrictiveAccessLogFile",
        "parameters"=>array("import_file"=>"{import_file}","log_file"=>"{log_file}")
    ),
);

