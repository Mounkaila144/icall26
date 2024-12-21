<?php

return array(
    
     "server_services_ajax"=>array("pattern"=>'/module/server/services/admin/{action}',"module"=>"server_services","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
    
    "server_services"=>array("pattern"=>'/services/server/admin/{action}',"module"=>"server_services","action"=>"Service{action}","requirements"=>array("action"=>".*")),

     "server_master_services"=>array("pattern"=>'/services/server/master/admin/{action}',"module"=>"server_services","action"=>"ServiceMaster{action}","requirements"=>array("action"=>".*")),

    );

