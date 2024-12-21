<?php

return array(
    "app_domoprime_iso"=>array("pattern"=>'/applications/domoprime/iso/admin/{action}',"module"=>"app_domoprime_iso","action"=>"{action}","requirements"=>array("action"=>".*")),
    "app_domoprime_iso_ajax"=>array("pattern"=>'/module/site/applications/domoprime/iso/admin/{action}',"module"=>"app_domoprime_iso","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
    
    "app_domoprime_iso_api2"=>array("pattern"=>'/api/v2/applications/iso0/admin/{action}',"module"=>"app_domoprime_iso","action"=>"api2{action}","requirements"=>array("action"=>".*")),
);

