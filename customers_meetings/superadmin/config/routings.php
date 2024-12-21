<?php

return array(
    "customers_meeting"=>array("pattern"=>'/customers/meeting/admin/{action}',"module"=>"customers_meetings","action"=>"{action}","requirements"=>array("action"=>".*")),
    "customers_meeting_ajax"=>array("pattern"=>'/module/site/customers/meeting/admin/{action}',"module"=>"customers_meetings","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
);

