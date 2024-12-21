<?php

return array(
    
    "site_services_ajax"=>array("pattern"=>'/module/site/services/admin/{action}',"module"=>"site_services","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
    
    "site_services"=>array("pattern"=>'/services/sites/admin/{action}',"module"=>"site_services","action"=>"Service{action}","requirements"=>array("action"=>".*")),

    "site_services_main"=>array("pattern"=>'/services/sites/services/admin/{action}',"module"=>"site_services","action"=>"{action}","requirements"=>array("action"=>".*")),

    );

