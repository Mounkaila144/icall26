<?php

return array(
    //"customers_meeting"=>array("pattern"=>'/customers/meeting/admin/{action}',"module"=>"customers_meetings","action"=>"{action}","requirements"=>array("action"=>".*")),
    "customers_meeting_forms_ajax"=>array("pattern"=>'/module/site/customers/meeting/forms/admin/{action}',"module"=>"customers_meetings_forms","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
);

