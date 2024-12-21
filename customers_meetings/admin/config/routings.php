<?php

return array(
    "customers_meeting"=>array("pattern"=>'/customers/meeting/admin/{action}',"module"=>"customers_meetings","action"=>"{action}","requirements"=>array("action"=>".*")),
    "customers_meeting_ajax"=>array("pattern"=>'/module/customers/meeting/admin/{action}',"module"=>"customers_meetings","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
    
    "customers_meeting_api"=>array("pattern"=>'/api/meeting/admin/{action}',"module"=>"customers_meetings","action"=>"api{action}","requirements"=>array("action"=>".*")),
    
    "customers_meeting_api2"=>array("pattern"=>'/api/v2/meetings/admin/{action}',"module"=>"customers_meetings","action"=>"api2{action}","requirements"=>array("action"=>".*")),
);

