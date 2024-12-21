<?php

return array(
     "dashboard_index"=>array("pattern"=>'/',"module"=>"dashboard","action"=>"index"),             
    
     "dashboard_ajax"=>array("pattern"=>'/module/dashboard/admin/{action}',"module"=>"dashboard","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
   //  "dashboard_cache"=>array("pattern"=>'/cache',"module"=>"dashboard","action"=>"cache"),
  //   "dashboard_ajaxLog"=>array("pattern"=>'/module/log/{action}',"module"=>"dashboard","action"=>"ajaxLog{action}","requirements"=>array("action"=>"(.*)?")),
   //  "dashboard_log_file"=>array("pattern"=>'/log/{file}',"module"=>"dashboard","action"=>"logfile","requirements"=>array("file"=>"(20[0-9][0-9]_[0-9][0-9]_[0-9][0-9]_system_error_(.*)\.log)"),"parameters"=>array("file"=>"{file}")),
   //  "dashboard_logExport"=>array("pattern"=>'/logExport',"module"=>"dashboard","action"=>"logExport"),
    // "dashboard_preferences"=>array("pattern"=>'/dashboard/preferences',"module"=>"dashboard","action"=>"preferencesView"),
   //  "dashboard_ajaxPreferences"=>array("pattern"=>'/module/dashboard/preferences/{action}',"module"=>"dashboard","action"=>"ajaxPreferences{action}","requirements"=>array("action"=>"(.*)?")),           
);

