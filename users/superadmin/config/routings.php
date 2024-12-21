<?php

return array(
      "users_dashboard_list"=>array("pattern"=>'/dashboard/users/admin',"module"=>"users","action"=>"ListDashboard"),
      "users_dashboard_ajax"=>array("pattern"=>'/module/dashboard/users/admin/{action}',"module"=>"users","action"=>"ajax{action}","requirements"=>array("action"=>"(.*)?")),
      "users_site_ajax"=>array("pattern"=>'/module/site/users/admin/{action}',"module"=>"users","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
    //  "users_guard_account"=>array("pattern"=>'/account/identity',"module"=>"users","action"=>"accountIdentity"),
    //  "users_guard_account_ajax"=>array("pattern"=>'/module/account/identity/{action}',"module"=>"users","action"=>"ajaxAccountIdentity{action}","requirements"=>array("action"=>"(.*)?")),
    //  "users_guard_site_list"=>array("pattern"=>'/users',"module"=>"users","action"=>"list"),
    //  "users_guard_site_export"=>array("pattern"=>'/users/export',"module"=>"users","action"=>"export"),
    //  "users_guard_site_ajax"=>array("pattern"=>'/module/users/{action}',"module"=>"users","action"=>"ajax{action}","requirements"=>array("action"=>"(.*)?")),
);

