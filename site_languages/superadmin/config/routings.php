<?php

return array(
        "languages_site_list"=>array("pattern"=>'/languages',"module"=>"languages","action"=>"list"),
        "languages_site_ajax"=>array("pattern"=>'/module/languages/{action}',"module"=>"languages","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
        "languages_dashboard_list"=>array("pattern"=>'/dashboard/languages',"module"=>"languages","action"=>"dashboardList"),
        "languages_dashboard_ajax"=>array("pattern"=>'/module/dashboard/languages/{action}',"module"=>"languages","action"=>"ajaxDashboard{action}","requirements"=>array("action"=>".*")),
    
);

/*
return array(
      //ok       "languages_list"=>array("pattern"=>'#^/languages$#',"module"=>"languages","action"=>"list"),
      //ok       "languages_ajax"=>array("pattern"=>'#^/module/languages/(.*)?$#',"module"=>"languages","action"=>"ajax\\1"),
      //ok       "languages_dashboard_list"=>array("pattern"=>'#^/dashboard/languages$#',"module"=>"languages","action"=>"dashboardList"),
      //ok       "languages_dashboard_ajax"=>array("pattern"=>'#^/module/dashboard/languages/(.*)$#',"module"=>"languages","action"=>"ajaxDashboard\\1"),
  );
 */