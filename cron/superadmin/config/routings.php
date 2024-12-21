<?php

return array(
    "cron_list"=>array("pattern"=>'/crons{root}',"module"=>"cron","action"=>"list","requirements"=>array("root"=>"/?")),
    "cron_ajax"=>array("pattern"=>'/module/cron/{action}',"module"=>"cron","action"=>"ajax{action}","requirements"=>array("action"=>"(.*)?")),
    "cron_execute"=>array("pattern"=>'/crons/execute',"module"=>"cron","action"=>"execute"),
   // "cron_export"=>array("pattern"=>'/cron/report',"module"=>"cron","action"=>"export"),
);

/*
return array(
            //ok "cron_list"=>array("pattern"=>'#^/crons/?$#',"module"=>"cron","action"=>"list"),
            //ok  "cron_execute"=>array("pattern"=>'#^/crons/execute?$#',"module"=>"cron","action"=>"execute"),
            "cron_export"=>array("pattern"=>'#^/cron/report$#',"module"=>"cron","action"=>"export"),
            //ok  "cron_ajax"=>array("pattern"=>'#^/module/cron/(.*)?$#',"module"=>"cron","action"=>"ajax\\1"),

  );
 */