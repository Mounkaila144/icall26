<?php

return array(
   // "users"=>array("pattern"=>'/users',"module"=>"users","action"=>"List"),
   // "users_export"=>array("pattern"=>'/users/export',"module"=>"users","action"=>"export"),
     "users"=>array("pattern"=>'/users/admin/{action}',"module"=>"users","action"=>"{action}","requirements"=>array("action"=>".*")),
    
     "users_ajax"=>array("pattern"=>'/module/site/users/admin/{action}',"module"=>"users","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
    
     "users_api"=>array("pattern"=>'/api/users/admin/{action}',"module"=>"users","action"=>"api{action}","requirements"=>array("action"=>".*")),
    
      "users_api_v2"=>array("pattern"=>'/api/v2/users/admin/{action}',"module"=>"users","action"=>"api2{action}","requirements"=>array("action"=>".*")),
);

