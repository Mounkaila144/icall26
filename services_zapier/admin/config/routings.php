<?php

return array(

    "services_zapier_ajax" => array("pattern" => '/module/service/zapier/admin/{action}', "module" => "services_zapier", "action" => "ajax{action}", "requirements" => array("action" => ".*")),

    "services_zapier"=>array("pattern"=>'/{action}',"module"=>"services_zapier","action"=>"{action}","requirements"=>array("action"=>".*")),


);

