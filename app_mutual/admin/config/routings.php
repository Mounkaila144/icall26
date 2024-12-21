<?php

return array(
    "app_mutual"=>array("pattern"=>'/applications/mutual/admin/{action}',"module"=>"app_mutual","action"=>"{action}","requirements"=>array("action"=>".*")),
    "app_mutual_ajax"=>array("pattern"=>'/module/site/applications/mutual/admin/{action}',"module"=>"app_mutual","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
);

